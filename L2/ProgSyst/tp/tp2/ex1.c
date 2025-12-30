#include <stdio.h>
#include <stdlib.h>

#define N 2

int **alloue_matrice() {
    int **m;
    m = malloc(N * sizeof(int *)); 
    for(int i=0;i<N;i++) {
        m[i] = malloc(N * sizeof(int)); 
        for(int j=0;j<N;j++) {
            m[i][j] = 0;
        }
    }
    return m;
}

void affiche_matrice(int **m) {
    for(int i=0;i<N;i++) {
        for(int j=0;j<N;j++) {
            printf("%d ", m[i][j]);
        }
        printf("\n");
    }
    printf("\n");
}

int** multiplie_matrice(int **m1, int **m2) {
    int **resultat = alloue_matrice();
    for(int i=0;i<N;i++) {
        for(int j=0;j<N;j++) {
            int c = 0;
            for(int k=0;k<N;k++) {
                c = c + m1[i][k] * m2[k][j];
            }
            resultat[i][j] = c;
        }
    }
    return resultat;
}

int main() {
    int **mat1 = alloue_matrice();
    mat1[0][0] = 1;
    mat1[0][1] = 0;
    mat1[1][0] = 2;
    mat1[1][1] = -1;
    affiche_matrice(mat1);
    int **mat2 = alloue_matrice();
    mat2[0][0] = 3;
    mat2[0][1] = 4;
    mat2[1][0] = -2;
    mat2[1][1] = -3;
    affiche_matrice(mat2);
    int **mat3 = multiplie_matrice(mat1, mat2);
    affiche_matrice(mat3);
}

