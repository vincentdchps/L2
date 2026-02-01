#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/file.h>

int main(int argc, char *argv[]) {

    if (argc!=2) {
        printf("Veuillez entrer un nom de fichier\n");
        exit(-1);
    }

    int fd = open(argv[1], O_RDONLY);
    if (fd == - 1) {
        perror("Ouverture du fichier");
        exit(-1);
    }

    unsigned char c;
    int i=0;

    while(read(fd, &c, 1)) {
        printf("%02x ", c);
        i = i + 1;
        if (i==8) {
            i=0;
            printf("\n");
        }
    }

    close(fd);
    printf("\n");
}
