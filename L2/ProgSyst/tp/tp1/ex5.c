#include <stdio.h>

// compter et afficher le nombre de caractère de chaque argument en ligne de commande

int main(int argc, char *argv[]) {

    if (argc < 2) {
        printf("Pas d'argument en ligne de commande\n");
        return -1;
    }

    for(int i=0;i<argc;i++) {
        int len = 0;
        while(argv[i][len] != '\0') len++;
        printf("argument n° %d = %s, longueur = %d\n", i, argv[i], len);
    }
    return 0;
}
