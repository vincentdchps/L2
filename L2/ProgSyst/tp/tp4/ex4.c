#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/file.h>

char nom_fichier[] = "fic1";

int main() {

    /*

    - si existant : ouverture et troncature ("remise à vide")
    - si inexistant : création

    */

    int fd = open(
        nom_fichier,
        O_WRONLY | O_CREAT | O_TRUNC,
        S_IRUSR | S_IWUSR | S_IRGRP
    );

    if (fd == - 1) {
        perror("Création du fichier");
        exit(-1);
    }

    unsigned char c;
    int i;

    for(i=0;i<256;i++) {
        c=(char)i;
        write(fd, &c, 1);
    }

    close(fd);
}
