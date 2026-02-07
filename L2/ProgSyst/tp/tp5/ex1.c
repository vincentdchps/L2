#include <stdio.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <unistd.h>

int main() {
    struct stat st;
    fstat(0, &st);
    printf("st_mode=%x S_ISREG=%d S_ISPIPE=%d S_ISCHR=%d\n",
        st.st_mode,
        S_ISREG(st.st_mode),
        S_ISFIFO(st.st_mode),
        S_ISCHR(st.st_mode)
    );
    return 0;
}
