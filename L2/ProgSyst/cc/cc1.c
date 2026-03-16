#include <stdio.h>
#include <unistd.h>
int main() {
	int p = fork();
	if (p > 0) {
		fork();
		printf("xxx\n");
	} else {
		printf("yyy\n");
	}
	printf("pid=%d\n", getpid());
}
