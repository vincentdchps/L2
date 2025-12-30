#include <stdio.h>
#include <stdlib.h>

// vérifier si une chaine se compose d'un même motif répété plusieurs fois

int main(int argc, char *argv[]) {

    if (argc < 2) {
        printf("Pas d'argument en ligne de commande\n");
        return -1;
    }
    char *s = argv[1];

    int len = 0;
    while(s[len] != '\0') len++;

    printf("longueur = %d\n", len);

    for(int k=1;k<=len/2;k++) {
        // test des répétitions de longueur k
        printf("répétition de longueur = %d ...\n", k);
        if (len%k == 0) { // est-ce que k est un multiple de len ?
            int repetition = 1;
            // compare chaque caractère de la position k à la position len-1 avec le caractère du supposé motif de répétition
            for(int i=k;i<len;i++) {
                if (s[i%k] != s[i]) { // est-ce que le caractère en position i correspond à un caractère du supposé motif de répétition
                    repetition = 0;
                }
            }
            if (repetition) {
                printf("Chaine '");
                for(int i=0;i<k;i++) printf("%c", argv[1][i]);
                printf("' répétée %d fois\n", len/k);
                return 0;
            }
        }
    }

    printf("Pas de répétition\n");
    return 0;
}
