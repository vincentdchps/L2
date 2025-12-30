#include <stdio.h>

// indiquer si les lettres du premier argument en ligne de commande sont dans l'ordre alphabétique
// à supposer que ces lettres sont soit toutes en minuscules, soit toutes en majuscule.

int main(int argc, char *argv[]) {

    if (argc < 2) {
        printf("Pas d'argument en ligne de commande\n");
        return -1;
    }

    int len = 0;
    while(argv[1][len] != '\0') len++;

    int estDanslOrdre = 1;
    char c=argv[1][0];
    for(int i=1;i<len;i++) {
        if (argv[1][i] < c) {
            estDanslOrdre = 0;
            break;
        }
        c = argv[1][i];
    }

    if (estDanslOrdre) {
        printf("Les lettres de '%s' sont dans l'ordre alphabétique\n", argv[1]);
    } else {
        printf("Les lettres de '%s' ne sont pas dans l'ordre alphabétique\n", argv[1]);
    }

    return 0;
}
