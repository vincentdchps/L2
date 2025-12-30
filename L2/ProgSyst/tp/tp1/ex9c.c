#include <stdio.h>

void f1(int *);
void f2(int *);
void f3(int *);

int main() {
  int k=0;
  printf("main - début\n"); k++;
  f1(&k);
  printf("main - hello\n"); k++;
  f2(&k);
  printf("main - fin\n"); k++;
  printf("k=%d\n", k);
}

void f1(int * k) {
  printf("f1 - début\n"); (*k)++;
  f2(k);
  printf("f1 - fin\n"); (*k)++;
}

void f2(int * k) {
  printf("f2 - début\n"); (*k)++;
  f3(k);
  printf("f2 - fin\n"); (*k)++;
}

void f3(int * k) {
  printf("f3 - hello\n"); (*k)++;
}

