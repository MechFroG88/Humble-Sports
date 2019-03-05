# API requests

## Users
* [ ] /user
  * [ ] GET
  * [ ] POST
* [ ] /user/password **PUT**
* [ ] /user/login **POST**
* [ ] /user/logout **POST**
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

* [ ] /item
  * [ ] GET
  * [ ] POST
* [ ] /item/record/{itemId} **GET**

---

## Fines

* [ ] /fine **GET**
* [ ] /fine/new **POST**

---

## Rents
- ### personal
  * [ ] /rent/personal
    * [ ] GET
    * [ ] POST
  * [ ] /rent/personal/{rentId}/return **PUT**
  * [ ] /rent/personal/{rentId}/lost **PUT**
  * [ ] /rent/personal/expired **PUT**
- ### group
  * [ ] /rent/group
    * [ ] GET
    * [ ] POST
  * [ ] /rent/group/{rentId}/return **PUT**
  * [ ] /rent/group/{rentId}/lost **PUT**
  * [ ] /rent/group/expired **PUT**

---

## Receipts
- personal
  * [ ] /receipt/personal/fine/{rentId} **POST**
  * [ ] /receipt/personal/lost/{rentId} **POST**
  * [ ] /receipt/persona/{receiptId} **GET**
- group
  * [ ] /receipt/group/fine/{rentId} **POST**
  * [ ] /receipt/group/lost/{rentId} **POST**
  * [ ] /receipt/group/{receiptId} **GET**

---

## Report
* [ ] /report **GET**