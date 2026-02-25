#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <pthread.h>

const int nb_threads = 10;

struct parametres {
    int borne1;
    int borne2;
    int * somme_finale;
    pthread_mutex_t * lock;
};

void * calculer(void * a) {

    struct parametres * p = (struct parametres *)a;

    int somme = 0;

    for(int j=p->borne1;j<=p->borne2;j++) somme = somme + j;
    printf("La somme de %d à %d est %d\n", p->borne1, p->borne2, somme);

    pthread_mutex_lock(p->lock);
    *(p->somme_finale) = *(p->somme_finale) + somme;
    pthread_mutex_unlock(p->lock);
}

int main() {

    int somme_finale = 0;
    pthread_mutex_t lock = PTHREAD_MUTEX_INITIALIZER;

    pthread_t tids[nb_threads];

    for(long i=0;i<nb_threads;i++) {
        struct parametres *p = malloc(sizeof(struct parametres));
        p->borne1 = 1+i*100;
        p->borne2 = (i+1)*100;
        p->somme_finale = &somme_finale;
        p->lock = &lock;
        pthread_t tid;
        pthread_create(&tid, NULL, calculer, p);
        tids[i] = tid;
    }

    for(int i=0;i<nb_threads;i++) {
        pthread_join(tids[i], NULL);
    }

    printf("La somme finale est %d\n", somme_finale);

}

