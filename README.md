# CurlSoapClient
Je commence ce document par une exposition succincte du contexte où on peut eventuellement avoir besoin cette implémentation.

"Nons avons un  PHP SOAP server dérrière une Authentification basique HTTP. du coup cette écriture new \SoapClient($wsdl, $options) ne fonctionne pas"


La solution qui vient tout de suite en tête, est de récupérer le wsdl (manuellement, statiquement), de le mettre sur sa machine puis lancer les appels soap

Le probèlme est que quand on est des situation varaiment pro (genre environement de dev, evironnement de test, environnement de pro), cette solution présentera

rapidement ses limites (déveopper et demander au gens de déploiement en prod de faire la manip pour récupérer le wsdl -car le wsdl dev n'est pas forcément

 celui du prod)

 Du coup la solution optimale est de récupérer dynamiquement le fichier dépendamment de l'environnement

 D'ou naissent ces deux petits orphelins (Option.php et SoapClientCurl.php)

 Amusez vous!!!
