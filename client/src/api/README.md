# API requests

## Users
* [ ] /user
  * [x] GET
  * [ ] POST
* [ ] /user/password `PUT`
* [x] /user/login `POST`
* [x] /user/logout `POST`
* [x] /user/current `GET`
* [ ] /user/{userId}
  * [ ] GET
  * [ ] POST
  * [ ] DELETE

---

## Students
* [ ] /student
  * [ ] GET
  * [ ] POST

---

## Items

* [x] /item
  * [x] GET
  * [x] POST
* [x] /item/record/{itemId} `GET`

---

## Fines

* [ ] /fine `GET`
* [ ] /fine/new `POST`

---

## Rents
- ### personal
  * [x] /rent/personal
    * [x] GET
    * [x] POST
  * [ ] /rent/personal/{rentId}/return `PUT`
  * [ ] /rent/personal/{rentId}/lost `PUT`
  * [ ] /rent/personal/expired `PUT`
- ### group
  * [ ] /rent/group
    * [x] GET
    * [ ] POST
  * [ ] /rent/group/{rentId}/return `PUT`
  * [ ] /rent/group/{rentId}/lost `PUT`
  * [ ] /rent/group/expired `PUT`

---

## Receipts
- personal
  * [ ] /receipt/personal/fine/{rentId} `POST`
  * [ ] /receipt/personal/lost/{rentId} `POST`
  * [ ] /receipt/persona/{receiptId} `GET`
- group
  * [ ] /receipt/group/fine/{rentId} `POST`
  * [ ] /receipt/group/lost/{rentId} `POST`
  * [ ] /receipt/group/{receiptId} `GET`

---

## Report
* [x] /report `GET`