# API requests

## Users
* [x] /user
  * [x] GET
  * [x] POST
* [ ] /user/password **`PUT`**
* [x] /user/login **`POST`**
* [x] /user/logout **`POST`**
* [x] /user/current **`GET`**
* [ ] /user/{userId}
  * [ ] GET
  * [x] POST
  * [x] DELETE

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
* [x] /item/record/{itemId} **`GET`**

---

## Fines

* [ ] /fine **`GET`**
* [ ] /fine/new **`POST`**

---

## Rents
- ### personal
  * [x] /rent/personal
    * [x] GET
    * [x] POST
  * [x] /rent/personal/{rentId}/return **`PUT`**
  * [x] /rent/personal/{rentId}/lost **`PUT`**
  * [x] /rent/personal/expired **`PUT`**
- ### group
  * [x] /rent/group
    * [x] GET
    * [x] POST
  * [x] /rent/group/{rentId}/return **`PUT`**
  * [x] /rent/group/{rentId}/lost **`PUT`**
  * [x] /rent/group/expired **`PUT`**

---

## Receipts
- personal
  * [x] /receipt/personal/fine/{rentId} **`POST`**
  * [x] /receipt/personal/lost/{rentId} **`POST`**
  * [x] /receipt/persona/{receiptId} **`GET`**
- group
  * [x] /receipt/group/fine/{rentId} **`POST`**
  * [x] /receipt/group/lost/{rentId} **`POST`**
  * [x] /receipt/group/{receiptId} **`GET`**

---

## Report
* [x] /report **`GET`**