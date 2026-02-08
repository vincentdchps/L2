#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>

const int nb_processus = 10;

int main() {

    int tubes[nb_processus][2];

    for(int i=0;i<nb_processus;i++) {
        pipe(tubes[i]);
        int pid=fork();
        if (pid==0) {
            // processus fils
            close(tubes[i][0]);
            int somme = 0;
            for(int j=(1+i*100);j<=((i+1)*100);j++) somme = somme + j;
            write(tubes[i][1], &somme, sizeof(int));
            exit(0);
        } else {
            // processus père
            close(tubes[i][1]);
        }
    }

    int somme = 0;
    for(int i=0;i<nb_processus;i++) {
        int somme_intermediaire;
        read(tubes[i][0], &somme_intermediaire, sizeof(somme_intermediaire));
        somme = somme + somme_intermediaire;
        printf("recu = %d\n", somme_intermediaire);
    };

    printf("somme = %d\n", somme);
}
