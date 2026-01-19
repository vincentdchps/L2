#include <stdio.h>
#include <unistd.h>

int main() {
    printf("avant fork ...\n");
    fork();
    printf("après 1e fork ...\n");
    fork();
    printf("après 2e fork ...\n");
    printf("getpid()=%d getppid()=%d\n", getpid(), getppid());
    pause();
}
