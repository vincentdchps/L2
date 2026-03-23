#include <arpa/inet.h>
#include <netinet/in.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/sem.h>
#include <sys/shm.h>
#include <sys/socket.h>
#include <sys/stat.h>
#include <unistd.h>
#define LONGUEUR_NOM 32
const int port_num = 2000;
const int maxlength = 256;
const char msg_bienvenue1[] = "Veillez entrer votre nom : ";
const char msg_bienvenue2[] = "Veillez entrer votre enchère : ";
void err(char s[]) {
	perror(s);
	exit(-1);
}
struct enchere {
	char nom[LONGUEUR_NOM];
	double montant;
};
void gere_client(int accept_sd, struct sockaddr_in addrcli, int len_addrcli) {
	int ret;
	char nom[LONGUEUR_NOM];
	char msg[maxlength];
	char replymsg[maxlength];
	int actif = 1;
	ret = sendto(accept_sd, msg_bienvenue1, strlen(msg_bienvenue1), 0,
				 (const struct sockaddr*)&addrcli, len_addrcli);
	printf("sendto = %d\n", ret);
	if (ret == -1) {
		err("sendto");
		actif = 0;
	}
	// attend le nom d'utilisateur
	ret = recvfrom(accept_sd, nom, LONGUEUR_NOM, 0, NULL, NULL);
	printf("Login de %s\n", nom);
	while (actif) {
		// attend un message
		ret = recvfrom(accept_sd, msg, maxlength, 0, NULL, NULL);
		if (ret == -1) {
			err("recvfrom");
			actif = 0;
		} else if (ret == 0) {
			printf("fin de la connexion\n");
			close(accept_sd);
			actif = 0;
		} else {
			msg[ret] = '\0';
			double montant = atof(msg);
			if (montant > meilleure_enchere) {
				snprintf(replymsg, maxlength,
						 "Votre enchere de %0.2f n'est pas retenue\n", montant);
				meilleure_enchere = montant;
			} else {
				snprintf(replymsg, maxlength,
						 "Votre enchere de %0.2f n'est pas retenue\n", montant);
			}
			// prépare et envoi une réponse
			ret = sendto(accept_sd, replymsg, strlen(replymsg), 0,
						 (const struct sockaddr*)&addrcli, len_addrcli);
			printf("sendto = %d\n", ret);
			if (ret == -1) {
				err("sendto");
				actif = 0;
			}
		}
	}
}
void main() {
	int sd;			// n° fd de la socket en attente des connexions
	int accept_sd;	// n° fd de la socket d'une connexion
	struct sockaddr_in addrsrv;
	struct sockaddr_in addrcli;
	int len_addrcli;
	struct enchere* meilleure_enchere;
	// creation d'un segment de memoire partage contentant un entier
	int id_shm = shmget(IPC_PRIVATE, sizeof(struct enchere),
						S_IWUSR | S_IRUSR | IPC_CREAT);
	// attache le segment de memoire partage
	meilleure_enchere = (struct enchere*)shmat(id_shm, NULL, 0);
	// valuer initiale du montant de l'enchere
	meilleure_enchere->montant = 0;
	if ((sd = socket(AF_INET, SOCK_STREAM, 0)) == -1)
		err("création socket");
	printf("Ce serveur attend les connexions sur le port %d\n", port_num);
	printf("n° fd de la socket = %d\n", sd);
	addrsrv.sin_family = AF_INET;
	addrsrv.sin_port = htons(port_num);
	addrsrv.sin_addr.s_addr = htonl(INADDR_ANY);
	if (bind(sd, (const struct sockaddr*)&addrsrv, sizeof(addrsrv)) != 0)
		err("bind");
	listen(sd, 1);
	while (1) {
		// attend une connexion
		len_addrcli = sizeof(addrcli);
		accept_sd = accept(sd, (struct sockaddr*)&addrcli, &len_addrcli);
		printf("n° fd de la connexion = %d, port = %d\n", accept_sd,
			   ntohs(addrcli.sin_port));
		int p = fork();
		if (p == 0) {
			/* boucle : attente d'un message du client en accept_sd / réponse */
			gere_client(accept_sd, addrcli, len_addrcli);
			exit(-1);
		}
	}
}
+63.
