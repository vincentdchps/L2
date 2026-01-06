#include <stdio.h>
#include <time.h>
#include <stdlib.h>
#include <unistd.h>

#define N 10
#define NS_ATTENTE 500000000

struct timespec attente = {0, NS_ATTENTE};

int main() {

  pid_t pid = fork();

  if (pid==-1) {
    exit(-1);
  }

  if (pid == 0) {
    // dans processus fils : affiche le n° du processus père
    printf("processus fils créé par le processus n° %d\n", getppid());
  } else {
    // dans processus père : affiche le n° de processus fils
    printf("création du processus fils n° %d\n", pid);
  }

  for(int i=1;i<=N;i++) {
    nanosleep(&attente, 0);
    printf("%d/%d (pid=%d)\n", i, N, getpid());
    fflush(stdout);
  }

}
