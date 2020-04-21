# Products

`GET /api/products`

```
[
  {
    "id": "1120299e-2dbf-4f72-8b31-ecdbaf4cf039",
    "name": "Toyota Corolla, rok 1997",
    "description": "Toyota Corolla, rok 1997. Sprowadzona z RFN.",
    "image": "https://loremflickr.com/g/1000/800/car"
  },
  {
    "id": "acc52e89-94e4-469c-946c-758123ff569f",
    "name": "Skoda Felicia, rok 1996",
    "description": "Felka 1.3, z czeskim silnikiem. Niezniszczalna. Wady: zardzewiała tylna klapa.",
    "image": "https://loremflickr.com/g/1000/800/car"
  }
]
```

`GET /api/products/acc52e89-94e4-469c-946c-758123ff569f`

```
{
  "id": "acc52e89-94e4-469c-946c-758123ff569f",
  "name": "Skoda Felicia, rok 1996",
  "description": "Felka 1.3, z czeskim silnikiem. Niezniszczalna. Wady: zardzewiała tylna klapa.",
  "image": "https://loremflickr.com/g/1000/800/car"
}
```

`POST /api/products`

```
{
  "name": "Skoda Felicia, rok 1996",
  "description": "Felka 1.3, z czeskim silnikiem. Niezniszczalna. Wady: zardzewiała tylna klapa.",
  "image": "https://loremflickr.com/g/1000/800/car"
}
```

# Stock And Reservations Node :D

`POST /api/stocks`

```
{
  "productId": "acc52e89-94e4-469c-946c-758123ff569f",
  "quantity": 2
}
```

`GET /api/stocks/<reservationId>`

```
{
  "id": "3cc52e89-14e4-469c-946c-758123ff569f",
  "productId": "acc52e89-94e4-469c-946c-758123ff569f",
  "quantity": 2
}
```

`DELETE /api/stocks/<reservationId>`

```
204 No content
```


`POST /api/stocks/<reservationId>/book`

```
{
  "quantity": 1
}
```

# Client bookings/reservations

`POST /api/bookings`

```
{
  "reservationId": "a90c2668-080c-46d8-a771-ec2b5780a00f" ,
  "clientId": "4eedb2d6-e17f-4409-ad4b-e6dee2fd24a7",
  "payer": "488a9a1b-7b2a-4441-b0d4-fab18b88a70f",
  "cost": "666.10",
  "created_at": "2020-04-21T10:59:00.0",
  "start_date": "2020-04-22T00:00:00.0",
  "end_date": "2020-04-22T00:00:00.0"
}
```

`GET /api/bookings`

```
[
  {
    "id": "d99bc207-33fb-41d4-be66-a6b6272b3158",
    "reservationId": "a90c2668-080c-46d8-a771-ec2b5780a00f" ,
    "clientId": "4eedb2d6-e17f-4409-ad4b-e6dee2fd24a7",
    "payer": "488a9a1b-7b2a-4441-b0d4-fab18b88a70f",
    "cost": "666.10",
    "created_at": "2020-04-21T10:59:00.0",
    "start_date": "2020-04-22T00:00:00.0",
    "end_date": "2020-04-22T00:00:00.0"
  }
]
```

`GET /api/bookings/d99bc207-33fb-41d4-be66-a6b6272b3158`

```
{
  "id": "d99bc207-33fb-41d4-be66-a6b6272b3158",
  "reservationId": "a90c2668-080c-46d8-a771-ec2b5780a00f" ,
  "clientId": "4eedb2d6-e17f-4409-ad4b-e6dee2fd24a7",
  "payer": "488a9a1b-7b2a-4441-b0d4-fab18b88a70f",
  "cost": "666.10",
  "created_at": "2020-04-21T10:59:00.0",
  "start_date": "2020-04-22T00:00:00.0",
  "end_date": "2020-04-22T00:00:00.0"
}
```