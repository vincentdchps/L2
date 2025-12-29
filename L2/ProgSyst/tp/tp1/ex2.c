#include <stdio.h>

int fib_for(int k) {
    if (k == 0) return 0;
    if (k == 1) return 1;

    int a = 0;
    int b = 1;
    int somme;
    int i;

 
    for (i = 2; i <= k; i++) {
        somme = a + b;
        a = b;        
        b = somme;    
    }
    return b;
}

/*Avec while :

int fib_while(int k) {
    if (k == 0) return 0;
    if (k == 1) return 1;

    int a = 0;
    int b = 1;
    int somme;
    int i = 2;

    while (i <= k) {
        somme = a + b;
        a = b;
        b = somme;
        i++;
    }
    return b;
}
    */



int main() {
    printf("fib(10) = %d\n", fib_for(10));
    return 0;
}

