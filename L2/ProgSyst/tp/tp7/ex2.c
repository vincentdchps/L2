#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <pthread.h>

const int nb_threads = 10;

void * calculer(void * p) {
    int i = (long)p;
    int borne1 = 1+i*100;
    int borne2 = (i+1)*100;
    long somme = 0;

    for(int j=borne1;j<=borne2;j++) somme = somme + j;
    printf("La somme de %d à %d est %ld\n", borne1, borne2, somme);
    return (void *)somme;
}

int main() {

    pthread_t tids[nb_threads];

    for(long i=0;i<nb_threads;i++) {
        pthread_t tid;
        pthread_create(&tid, NULL, calculer, (void *)i);
        tids[i] = tid;
    }

    long somme_finale=0;
    for(int i=0;i<nb_threads;i++) {
        long ret;
        pthread_join(tids[i], (void *) &ret);
        somme_finale = somme_finale + ret;
    }

    printf("La somme finale est %ld\n", somme_finale);
}

