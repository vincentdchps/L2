# TP SSH 2025

## Installation du serveur openssh

### **Donner la commande à utiliser pour l’installation et la sortie de terminal.**

```bash
sudo apt-get install ssh
```


### Sur quelle(s) IP écoute par défaut le serveur SSH ? Donner une sortie de terminal qui valide votre réponse.

Par défaut, SSH écoute sur **toutes** les interfaces réseaux disponibles de la machine.

```bash
sudo netstat -tulpn | grep ssh
```

Résultat attendu : 

```bash
LISTEN   0    128     0.0.0.0:22      0.0.0.0:* users:(("sshd",pid=123,fd=3))
LISTEN   0    128        [::]:22         [::]:* users:(("sshd",pid=123,fd=4))
```


## Connexion par login/mot de passe

### Illustrer par une extraction de logs du serveur le succès de l’authentification.

Authentification: 
```bash
ssh user@192.168.56.2
```

Extraction des logs: 

```bash
sudo journalctl -f -u ssh
```

Résultat attendu montrant le succès de l'authentification : 

```bash
Jan 23 10:05:00 server sshd[2500]: Accepted password for user from 192.168.56.1 port 54321 ssh2
Jan 23 10:05:00 server sshd[2500]: pam_unix(sshd:session): session opened for user user by (uid=0)
```

### Donner le contenu du fichier des hosts connus de votre client (known_hosts).

Commande : 

```bash
cat ~/.ssh/known_hosts
```

Exemple de sortie : 

```bash
|1|FzX9...hash...=|...hash...= ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAI...
# Ou format clair :
192.168.56.2 ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTY...
```
## Authentification par clés. Création des clés sur « client » pour le compte « user ».

### Donner la signification des options de la commande utilisée à l’étape 2.

Commande :

```bash
ssh-keygen -b 4096 -t rsa
```

`-t rsa` : spécifie le type d'algorithme de chiffrement à utiliser pour générer la clé, donc ici RSA.

`-b 4096` : spécifie la taille en bits de la clé , ansi 4096 bits offre un niveau de sécurité très élevé.

### Regarder le fichier ~/.ssh/authorized_keys du compte « user » sur la machine « serveur ». Que contient-il ? À quoi cela sert-il ?

Ce fichier contient la clé publique de l'utilisateur "client" . Elle commence généralement par ssh-rsa AAAA... et finit par user@client.
Cela permet donc de se connecter sans mots de passe si la signature numérique du client correspond à une des clés publique présent dans le fichier .

### Donner les logs montrant le succès de l’authentification par clé pour le compte « user » sur la machine serveur.

Exemple de sortie : 

```bash
Jan 23 10:15:00 server sshd[2600]: Accepted publickey for user from 192.168.56.1 port 54322 ssh2: RSA SHA256:Kp...
```

## Transfert de fichier

### Donner la commande que vous utilisez, et expliquez là.

```bash
scp user@192.168.56.2:~/test.txt .
```

`scp` : outil de copie sécurisée via SSH

`user@192.168.56.2` : : indique l'utilisateur et l'adresse IP de la machine distante

`:~/test.txt` : indique le chemin du fichier sur le serveur.

`.` : indique la destination, c'est-à-dire le répertoire courant sur la machine du client.

### Quelle commande faudrait-il utiliser pour envoyer ce fichier de la machine « client » vers « serveur » ?

Il suffit d'inverser les sources et destinataires de la commande de base : 

```bash
scp test.txt user@192.168.56.2:/home/user/
```

