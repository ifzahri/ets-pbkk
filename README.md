# Group Report: CRUD Implementation with Laravel 11 and Flowbite

## Group Identity

- **Group Number**: 
- **Members**:
  - [Iftala Zahri Sukmana] - [5025221002]
  - [Fairuuz Azmi Firas] - [5025221057]
- **Project Title**: [Mediheal]

---

## 1. Project Plan

### 1.1 Goals
- Develop a CRUD application for [describe the system, e.g., a medical consultation system].
- Use Laravel 11 for backend logic and database management.
- Integrate Flowbite for responsive UI components and a modern user experience.

### 1.2 Tasks and Timeline
- **Week 1**: Set up the Laravel 11 environment and create the basic project structure.
- **Week 2**: Develop database models and migrations for [e.g., users, doctors, patients, consultations].
- **Week 3**: Implement CRUD functionality for [e.g., consultations, user accounts].
- **Week 4**: Integrate Flowbite components into Blade templates for UI consistency.
- **Week 5**: Test and finalize the application.

---

## 2. Results

### 2.1 Functionalities Achieved
- [✓] Users can create, read, update, and delete [e.g., consultation records].
- [✓] Doctors can view their appointments and accept or reject consultations.
- [✓] Flowbite components integrated for navigation, modals, and form inputs.
  
### 2.2 Challenges and Solutions
- **Challenge**: Integrating Flowbite with Blade templates.
  - **Solution**: Customized Flowbite’s components to align with Blade templating structure.
- **Challenge**: Handling update logic for partial fields (e.g., doctors updating `penanganan` only).
  - **Solution**: Used `muted` fields in the form and Laravel controllers to ensure only the intended field is updated.

---

## 3. Implementation

### 3.1 Setting Up Laravel 11
1. **Installation**:
   ```bash
   composer create-project --prefer-dist laravel/laravel medical-consultation
