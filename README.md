# نظام إدارة الأسطول (حجز الحافلات) - Fleet Management System (Bus Booking)

وصف قصير لمشروعك: [ دا مشروع حجز رحلات عبارة عن ان اليوزر يقدر يحجز اي رحلة من الرحلاة المتاحة او يستعلم عن الرحلات المتاحة وممكن يحجز  يحجز رحلة بين اي مدينتين بشرط يكونو ف مسار الرحلة  .]

##  المحتويات

- [الميزات](#الميزات)
- [التثبيت](#التثبيت)
- [الاستخدام](#الاستخدام)
- [واجهة برمجة التطبيقات (API)](#واجهة-برمجة-التطبيقات-api)
- [مخطط ERD](#مخطط-erd)
- [التكوينات الخاصة](#التكوينات-الخاصة)


- [معلومات إضافية](#معلومات-إضافية)


## الميزات

*   [هوا نظام سلس وبسيط وسهل الاستخام يوفر للمستخد تجربة بسيطة وسهلة دون مواجهة مشاكل  .]

## التثبيت

1.  استنساخ المستودع:
    ```bash
    git clone [https://github.com/MomenAnoh/Fleet_Management.git]
    ```



2.  تثبيت التبعيات:
    ```bash
    composer install
    ```

3.  نسخ ملف .env:
    ```bash
    cp .env.example .env
    ```

4.  تشغيل الترحيلات:
    ```bash
    php artisan migrate
    ```

5.  توليد مفتاح التطبيق:
    ```bash
    php artisan key:generate
    ```

6.  php artisan db:seed

## الاستخدام

*   تشغيل التطبيق: `php artisan serve`
*   الوصول إلى التطبيق: [اذكر رابط الوصول إلى التطبيق، مثلاً: http://127.0.0.1:8000]

## واجهة برمجة التطبيقات (API)

## واجهة برمجة التطبيقات (API)

### المصادقة (Authentication)

* **POST /api/login:** تسجيل دخول المستخدم.
    * **المعاملات:**
        * `email` (string): بريد المستخدم الإلكتروني.
        * `password` (string): كلمة مرور المستخدم.
    * **مثال للطلب (JSON):**
        ```json
        {
            "email": "[email address removed]",
            "password": "password123"
        }
        ```
    * **مثال للاستجابة (JSON):**
        ```json
        {
            "token": "eyJ..." 
        }
        ```
    * **رموز الحالة:**
        * 200 OK: تم تسجيل الدخول بنجاح.
                                                                                                                                                                                         بيانات اعتماد غير صحيحة. : 400  * 

* **POST /api/register:** تسجيل مستخدم جديد.
    * **المعاملات:**
        * `name` (string): اسم المستخدم.
        * `email` (string): بريد المستخدم الإلكتروني.
        * `password` (string): كلمة مرور المستخدم.
        * `password_confirmation` (string): تأكيد كلمة المرور.
    * **مثال للطلب (JSON):**
        ```json
        {
            "name": "John Doe",
            "email": "[email address removed]",
            "password": "password123",
            "password_confirmation": "password123"
        }
        ```
    * **مثال للاستجابة (JSON):**
        ```json
        {
            "user": {
                "id": 1,
                "name": "John Doe",
                "email": "[email address removed]"
            }
        }
        ```
    * **رموز الحالة:**
        * 201 Created: تم إنشاء المستخدم بنجاح.
        * 422 Unprocessable Entity: بيانات غير صحيحة أو مفقودة.

* **POST /api/logout:** تسجيل خروج المستخدم.
    * **مثال للاستجابة (JSON):**
        ```json
        {
            "message": "Logged out"
        }
        ```
    * **رموز الحالة:**
        * 200 OK: تم تسجيل الخروج بنجاح.

### إدارة المدن (Cities Management)

* **POST /api/add_Cities:** إضافة مدينة جديدة (يتطلب مصادقة).
    * **المعاملات:**
        * `City_Name` (string): اسم المدينة.
    * **مثال للطلب (JSON):**
        ```json
        {
            "City_Name": "Cairo"
        }
        ```
    * **مثال للاستجابة (JSON):**
        ```json
        {
            // ... (تفاصيل المدينة التي تم إنشاؤها)
        }
        ```
    * **رموز الحالة:**
      * 201 Created : تم انشاء المدينة بنجاح
      * 400 Bad Request :  يوجد خطأ في البيانات المرسلة

### إدارة الرحلات (Trips Management)

* **POST /api/add_Trips:** إضافة رحلة جديدة (يتطلب مصادقة).
    * **المعاملات:**
        * `From` (integer): معرف مدينة الانطلاق.
        * `to` (integer): معرف مدينة الوصول.
        // أضف معاملات أخرى حسب الحاجة (مثل bus_id, departure_time, إلخ)
    * **مثال للطلب (JSON):**
        ```json
        {
            "From": 1,
            "to": 2
            // ...
        }
        ```
    * **مثال للاستجابة (JSON):**
        ```json
        {
            // ... (تفاصيل الرحلة التي تم إنشاؤها)
        }
        ```
    * **رموز الحالة:**
      * 201 Created : تم انشاء الرحلة بنجاح
      * 400 Bad Request :  يوجد خطأ في البيانات المرسلة

* **GET /api/show_trips:** عرض الرحلات المتاحة.
    * **المعاملات:** (يمكن إضافة معاملات للبحث أو التصفية)
    * **مثال للاستجابة (JSON):**
        ```json
        [
            {
                "id": 1,
                "From": { "City_Name": "Cairo" }, // مثال: تضمين اسم المدينة
                "to": { "City_Name": "Alexandria" }, // مثال: تضمين اسم المدينة
                // ... (تفاصيل الرحلات)
            },
            // ...
        ]
        ```
    * **رموز الحالة:**
      * 200 OK : تم عرض الرحلات بنجاح

### إدارة محطات التوقف (Stops Management)

* **POST /api/add_Stops_Cities:** إضافة محطات توقف لرحلة (يتطلب مصادقة).
    * **المعاملات:**
        * `trip_id` (integer): معرف الرحلة.
        * `city_id` (integer): معرف المدينة (محطة التوقف).
        * `order` (integer): ترتيب التوقف في الرحلة.
    * **مثال للطلب (JSON):**
        ```json
        {
            "trip_id": 1,
            "city_id": 3,
            "order": 2
        }
        ```
    * **مثال للاستجابة (JSON):**
        ```json
        {
            // ... (رسالة تأكيد)
        }
        ```
    * **رموز الحالة:**
      * 201 Created : تم اضافة محطة التوقف بنجاح
      * 400 Bad Request :  يوجد خطأ في البيانات المرسلة

### إدارة الحافلات (Buses Management)

* **POST /api/add_buses:** إضافة حافلة جديدة (يتطلب مصادقة).
    * **المعاملات:**
        * `trip_id` (integer): معرف الرحلة.
        * `total_seets` (integer): عدد المقاعد في الحافلة.
    * **مثال للطلب (JSON):**
        ```json
        {
            "trip_id": 1,
            "total_seets": 12
        }
        ```
    * **مثال للاستجابة (JSON):**
        ```json
        {
            // ... (تفاصيل الحافلة التي تم إنشاؤها)
        }
        ```
    * **رموز الحالة:**
      * 201 Created : تم انشاء الحافلة بنجاح
      * 400 Bad Request :  يوجد خطأ في البيانات المرسلة

### حجز المقاعد (Bookings)

* **POST /api/book_seat:** حجز مقعد (يتطلب مصادقة).
    * **المعاملات:**
        * `Name` (string): اسم الراكب.
        * `phone` (string): رقم هاتف الراكب.
        * `seat_id` (integer): معرف المقعد.
        * `bus_id` (integer): معرف الحافلة.
        * `trip_id` (integer): معرف الرحلة.
        * `from` (integer): معرف مدينة الانطلاق.
        * `to` (integer): معرف مدينة الوصول.
    * **مثال للطلب (JSON):**
        ```json
        {
            "Name": "John Doe",
            "phone": "01234567890",
            "seat_id": 1,
            "bus_id": 1,
            "trip_id": 1,
            "from": 1,
            "to": 2
        }
        ```
    * **مثال للاستجابة (JSON):**
        ```json
        {
            // ... (رسالة تأكيد الحجز)
        }
        ```
    * **رموز الحالة:**
      * 201 Created : تم حجز المقعد بنجاح
      * 400 Bad Request :  يوجد خطأ في البيانات المرسلة

### عرض المقاعد المتاحة (Available Seats)

* **GET /api/available_seats:** عرض المقاعد المتاحة.
    * **المعاملات:** (يمكن إضافة معاملات للبحث أو التصفية، مثال: `trip_id` أو `from_city_id`, `to_city_id` و `date`)
    * **مثال للاستجابة (JSON):**
        ```json
        [
            { "seat_number": 1, "status": "available" },
           
            // ...
        ]
## رابط مخطط قاعدة البيانات 

https://drive.google.com/file/d/1NMr54sexuw90gi-W-ozuL2vBD-TKMJxb 

## التكوينات الخاصة

[يجب انشاء ميتخد اولا وتسجيل الدخول به ثم الاستخدام الطبيعي لل برنامج ]
## معلومات إضافية

*   Devolper: [Momen Ahmed]
*   Company: [Smart Technology Solutions ]
