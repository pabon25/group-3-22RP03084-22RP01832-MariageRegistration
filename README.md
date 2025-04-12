# 💻 DEVELOPERS ⚠️

1. MBONIMPA ISHIMWE Theogene 22RP01832
2. MASEGESHO PACIFIQUE 22RP03084

# 💍 Marriage Application Portal

A Laravel-based web portal for managing digital marriage applications, tailored for both **Applicants** and **Administrators**.

---

## 🚀 Getting Started ⚠️

Follow these steps to set up the project locally:

1. **Create a folder** to store the project.
2. **Navigate into the folder**, then run:

    ```bash
    git clone --branch group-3-22RP03084-22RP01832-MariageRegistration --single-branch https://github.com/pabon25/group-3-22RP03084-22RP01832-MariageRegistration.git .
    ```

3. **Install dependencies**: ⚠️

    ```bash
    composer update
    ```

4. **Run migrations**:

    ```bash
    php artisan migrate
    ```

5. **Start the development server**:

    ```bash
    php artisan serve
    ```

---

## 📋 User Guide

### 👤 For Applicants

#### 📝 Registration

1. Click **Register** on the homepage.
2. Fill in your personal details:
    - Full Name
    - Email Address
    - Phone Number
    - Date of Birth
    - Address
3. Create a password.
4. Click **Register** to complete.

#### 💒 Marriage Application

1. Login to your account.
2. Click **New Application** on your dashboard.
3. Fill in the application form:
    - **Spouse Details**: Name, Gender, Date of Birth, Email, Phone, Address.
    - **Witness Details**: Name, Contact Information.
    - **Marriage Details**: Date, Location.
4. Upload required documents:
    - Groom's ID Card
    - Groom's Passport Photo
    - Bride's ID Card
    - Bride's Passport Photo
5. Click **Submit**.

#### 📦 Tracking Application

1. View your dashboard.
2. Check application status:
    - 🟡 **Pending**
    - 🟢 **Approved**
    - 🔴 **Rejected**
3. View application details.
4. When approved, the **Download Certificate** button will be shown.

---

### 🛠️ For Administrators

#### 🔐 Login

1. Access the admin login page.
2. Use the following credentials:

    - **Email**: `admin@admin.com`
    - **Password**: `password`

3. Click **Login**.

#### 🗂 Application Management

1. Access the admin dashboard.
2. View all submitted applications.
3. Click on any application to see full details.
4. Review information and uploaded documents.
5. Approve or reject applications.
6. Add remarks if necessary.

---

## 🧰 System Requirements

-   PHP >= 8.0
-   Composer
-   Laravel
-   MySQL or MariaDB
-   Web server (Apache/Nginx)

---

## 📞 Support

For support or technical inquiries, please contact the system administrator.
