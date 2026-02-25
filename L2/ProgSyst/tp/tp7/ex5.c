#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/socket.h>
#include <arpa/inet.h>
#include <pthread.h>

const int port_num = 2000;
const int msg_max_length = 256;
const char * welcome_msg = "Bienvenue\n";

struct client {
  int accept_sd;
  struct sockaddr_in addrcli;
  int len_addrcli;
};

void * gere_client(void * p) {

  int ret;
  char msg[msg_max_length];
  char replymsg[msg_max_length];

  struct client *c = (struct client *) p;
  int accept_sd = c->accept_sd;
  struct sockaddr_in addrcli = c->addrcli;
  int len_addrcli = c->len_addrcli;

  ret = sendto(accept_sd, welcome_msg, strlen(welcome_msg), 0, (const struct sockaddr*)&addrcli, len_addrcli);
  if (ret == -1) {
    perror("sendto");
    return NULL;
  }

  // boucle attente de message/réponse
  while (1) {

    // attend un message
    ret = recvfrom(accept_sd, msg, msg_max_length, 0, NULL, NULL);
    if (ret == -1) {
      perror("recvfrom");
      return NULL;
    }
    if (ret == 0) {
      printf("Déconnexion\n");
      close(accept_sd);
      return NULL; // déconnexion : termine le processus fils
    }
    msg[ret] = '\0';
    printf("(recvfrom = %d)\n", ret);

    snprintf(replymsg, msg_max_length, "Votre message : %s\n", msg);

    ret = sendto(accept_sd, replymsg, strlen(replymsg), 0, (const struct sockaddr*)&addrcli, len_addrcli);
    if (ret == -1) {
      perror("sendto");
      return NULL;
    }
    printf("(sendto = %d)\n", ret);
  }
}

void main() {

  int sd;         // n° fd de la socket en attente des connexions
  int accept_sd;  // n° fd de la socket d'une connexion

  struct sockaddr_in addrsrv;

  printf("Ecoute sur le port %d\n", port_num);

  // création socket
  if ( (sd = socket(AF_INET, SOCK_STREAM, 0)) == -1) {
    perror("création socket");
    exit(-1);
  }

  addrsrv.sin_family = AF_INET;
  addrsrv.sin_port = htons(port_num);
  addrsrv.sin_addr.s_addr = htonl(INADDR_ANY);

  if (bind(sd, (const struct sockaddr *)&addrsrv, sizeof(addrsrv)) != 0) {
    perror("bind");
    exit(-1);
  }

  listen(sd, 1);

  while (1) {
    // attend une connexion
    struct client c;
    c.len_addrcli = sizeof(c.addrcli);

    accept_sd = accept(sd, (struct sockaddr *)&c.addrcli, &c.len_addrcli);
    if (accept_sd == -1) {
      perror("accept");
      exit(-1);
    }
    printf("n° fd de la connexion = %d, port = %d\n", accept_sd, ntohs(c.addrcli.sin_port));

    pthread_t tid;
    c.accept_sd = accept_sd;

    pthread_create(&tid, 0, gere_client, &c);

  }
}
