#include <stdio.h>

void f1();
void f2();
void f3();

int main() {
  printf("main - début\n");
  f1();
  printf("main - hello\n");
  f2();
  printf("main - fin\n");
}

void f1() {
  printf("f1 - début\n");
  f2();
  printf("f1 - fin\n");
}

void f2() {
  printf("f2 - début\n");
  f3();
  printf("f2 - fin\n");
}

void f3() {
  printf("f3 - hello\n");
}

