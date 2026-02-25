#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <pthread.h>

const int nb_threads = 10;

int somme_finale = 0;
pthread_mutex_t lock = PTHREAD_MUTEX_INITIALIZER;

void * calculer(void * p) {
    int i = (long)p;
    int borne1 = 1+i*100;
    int borne2 = (i+1)*100;
    int somme = 0;

    for(int j=borne1;j<=borne2;j++) somme = somme + j;
    printf("La somme de %d à %d est %d\n", borne1, borne2, somme);

    pthread_mutex_lock(&lock);
    somme_finale = somme_finale + somme;
    pthread_mutex_unlock(&lock);
}

int main() {

    pthread_t tids[nb_threads];

    for(long i=0;i<nb_threads;i++) {
        pthread_t tid;
        pthread_create(&tid, NULL, calculer, (void *)i);
        tids[i] = tid;
    }

    for(int i=0;i<nb_threads;i++) {
        pthread_join(tids[i], NULL);
    }

    printf("La somme finale est %d\n", somme_finale);

}

