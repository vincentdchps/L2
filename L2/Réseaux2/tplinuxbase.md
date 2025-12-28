## TP Révision commande Linux- Réseau 

### En vous aidant du man et d’internet mettre une adresse ip avec l’une de ces commandes. Réseau (192.168.4.0/24) sur enp0s8 .
### Donner la commande et une preuve de la réussite de votre commande.

Commande : 

```bash
sudo ip addr add 192.168.4.10/24 dev enp0s8
```

Preuve : 

```bash
ip addr show enp0s8
```
