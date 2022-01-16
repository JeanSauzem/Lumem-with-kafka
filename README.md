# Lumen com Mensageria usando kafka

* Estou utilizando Service Layer para produzir e consumir
* Usando Abstract Factory para criar instância com o kafka
* estou usando docker e docker-compose

## Como fazer funcionar

* `docker-compose up -d --build`

##  Instalar Dependência Composer e copiar .env.example para .env

# Produzir

* digitar a url `http://localhost:8033/producer?topic=chat-abc&payload=tudo%20bem`  ou via curl `curl --request GET \
  --url 'http://localhost:8033/producer?topic=chat-abc&payload=tudo%20be' \
  --cookie PHPSESSID=k4bhc16h45ae8bacglidenc7f0`

# Consumir

 * `docker exec -it api-mensagem php artisan ConsumerTopic chat-abc` o "chat-abc" é o nome do topico

# Observações 
* setar o ip no dns kafka

```
docker exec -it api-mensagem bash 

echo '175.111.0.1   kafka' >> /etc/hosts

```