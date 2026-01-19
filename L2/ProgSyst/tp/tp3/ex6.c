#include <stdio.h>
#include <stdlib.h>
#include <signal.h>
#include <unistd.h>
#include <sys/wait.h>

#define N 3

void init_processus_fils() {
  while (1) {
    sleep(1);
  }
}

int main() {

  int t[N];
  int en_pause[N];

  for(int i=0;i<N;i++) {
    int pid = fork();
    if (pid == 0) init_processus_fils();
    t[i] = pid;
  }

  int r;
  int statut;
  do {
    printf("Processus fils : ");
    for(int i=0;i<N;i++) {
      if (i>0) {
        printf("; ");
      }
      if (en_pause[i]==1) {
        printf("%d en pause ", t[i]);
      } else {
        printf("%d actif    ", t[i]);
      }
    }
    printf("\n");
    r = waitpid(-1, &statut, WSTOPPED | WCONTINUED);
    printf(" ... waitpid a retourné %d\n\n", r);
    if (r != -1) {
      // recherche l'indice du processus concerné dans le tableau t
      int indice_processus=0;
      int trouve = 0;
      while(indice_processus<N && !trouve) {
        if (r==t[indice_processus]) {
          trouve=1;
        } else {
          indice_processus = indice_processus + 1;
        }
      }
      if (trouve) {
        if (WIFSTOPPED(statut)) {
          // le processus fils a été mise en pause (ou "stoppé")
          en_pause[indice_processus] = 1;
        } else if (WIFCONTINUED(statut)) {
          // le processus fils a été relancé (ou "continué")
          en_pause[indice_processus] = 0;
        } else if (WIFSIGNALED(statut)) {
          // le processus fils a été terminé par la reception d'un signal
          en_pause[indice_processus] = 0;
          int pid = fork();
          if (pid==0) init_processus_fils();
          t[indice_processus]=pid;
        }
      }
    }
  } while (r != -1);

}
