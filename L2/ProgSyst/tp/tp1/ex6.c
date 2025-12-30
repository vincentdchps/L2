#include <stdio.h>

// indiquer si le premier argument en ligne de commande est un palindrome

int main(int argc, char *argv[]) {

    if (argc < 2) {
        printf("Pas d'argument en ligne de commande\n");
        return -1;
    }

    // détermine la longueur de la chaine
    int len = 0;
    while(argv[1][len] != '\0') len++;

    int estPalindrome = 1;

    int i=0;

    while (i<len/2 && estPalindrome) {
        // condition de sortie de la boucle fin de parcours de la moitié de la chaine ou la chaine n'est pas un palindrome
        if (argv[1][i] != argv[1][len-1-i]) {
            estPalindrome = 0; // différence entre le caractère en position i et celui en position len-1-i : ce n'est pas un palindrome
        }
        i++;
    }

    if (estPalindrome) {
        printf("'%s' est un palindrome\n", argv[1]);
    } else {
        printf("'%s' n'est pas un palindrome\n", argv[1]);
    }

    return 0;
}
