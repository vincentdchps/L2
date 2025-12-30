#include <stdio.h>
#define N 4

int main() {

    int t[N] = {9,11,14,15};

    double somme = 0;

    for(int i=0;i<N;i++) {
        somme = somme + t[i];
    }


    printf("%.2f\n", somme/N);

}
