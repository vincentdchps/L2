#include <stdio.h>
#include <unistd.h>

const char d[] = "/mnt/c/workspace/";

int main() {
    int tube[2];
    pipe(tube);
    printf("%d %d\n", tube[0], tube[1]);

    pid_t pid=fork();

    if (pid>0) {
        close(tube[0]);
        dup2(tube[1], STDOUT_FILENO);
        execlp("du", "du", "--max-depth=1", "-BK", d, NULL);
    } else if (pid==0) {
        close(tube[1]);
        dup2(tube[0], STDIN_FILENO);
        execlp("sort", "sort", "-h", NULL);
    }
}
