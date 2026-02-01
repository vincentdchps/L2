#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <errno.h>
#include <fcntl.h>
#include <sys/file.h>
#include <sys/wait.h>

char nom_fichier[] = "soustotaux";
int nb_processus = 10;

int main() {

    // supprime le fichier "soustotaux"
    int suppr = unlink(nom_fichier);
    if (suppr == 0) {
        printf("Suppression de %s\n", nom_fichier);
    } else {
        if (errno == ENOENT) {
           printf("le fichier %s n'existait pas\n", nom_fichier);
        } else {
           perror("erreur suppression de fichier");
           exit(-1);
        }
    }

    for(int i=0;i<nb_processus;i++) {
        int pid=fork();
        if (pid==0) {
            // processus fils
            int borne1 = 1+i*100;
            int borne2 = (i+1)*100;
            int somme = 0;
            for(int j=borne1;j<=borne2;j++) somme = somme + j;
            printf("La somme de %d à %d est %d (pid=%d)\n", borne1, borne2, somme, getpid());

            // ouverture du fichier "soustotaux", en création si inexistant
            int fd = open(nom_fichier, O_WRONLY | O_CREAT | O_APPEND, S_IRUSR | S_IWUSR);
            if (fd == -1) {
                perror("erreur d'ouverture du fichier");
                exit(-1);
            }

            // pose d'un verrou exclusif
            flock(fd, LOCK_EX);

            write(fd, &somme, sizeof(int));

            // libération du verrou
            flock(fd, LOCK_UN);

            //fermeture du fichier
            close(fd);

            exit(0);
        }
    }

    // processus père

    // attente de terminaison des processus fils
    for(int i=0;i<nb_processus;i++) {
        pid_t pid_fils = wait(NULL);
        printf("Terminaison du processus fils %d\n", pid_fils);
    }

    // ouverture du fichier "soustotaux"
    int fd = open(nom_fichier, O_RDONLY);

    // pose d'un verrou exclusif
    flock(fd, LOCK_EX);

    // récupération et cumul des entiers écrits par les processus fils
    int total = 0;
    int soustotal;

    for(int i=0;i<nb_processus;i++) {
        read(fd, &soustotal, sizeof(int));
        total = total + soustotal;
    }
    printf("La somme des nombres de 1 à 1000 est %d\n", total);

    // libération du verrou
    flock(fd, LOCK_UN);

    close(fd);

}
