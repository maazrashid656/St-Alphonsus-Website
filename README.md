# St Alphonsus Website

## Overview
This web-based system efficiently manages school records, including pupils, parents, teachers, and classes. It provides an easy-to-use interface for adding, updating, and retrieving information.

## Database Structure
- **Database:** `st_alphonsus`
- **Tables:**
  - **Classes**: Stores class details, capacities, and assigned teachers.
  - **Pupils**: Holds student details, including DOB, address, medical info, and class assignment.
  - **Parents**: Contains parent/guardian contact details linked to multiple pupils.
  - **Teachers**: Records teacher details, including salary and background check status.

### Relationships & Constraints
- **Foreign Keys (FKs):** Establish links between pupils, parents, teachers, and classes.
- **ON DELETE SET NULL:** Ensures data integrity.
- **Primary Keys (PKs):** Uniquely identify records.
- **Unique Constraints:** Ensure data consistency (e.g., TeacherID is unique per class).
- **Auto-increment:** Generates unique IDs.

## PHP Code Structure
### 1. Homepage (`index.php`)
- Establishes a **database connection** via `db.php`.
- Provides **navigation links** for managing classes, pupils, parents, and teachers.

### 2. Pupil Management
- **Files:** `add_pupil.php`, `edit_pupil.php`, `view_pupil.php`, `delete_pupil.php`
- **Key Features:**
  - Dropdown for class selection.
  - Parent-child linking.
  - Secure database handling.
  - Medical info storage.

### 3. Teacher Management
- **Files:** `add_teacher.php`, `edit_teacher.php`, `view_teacher.php`, `delete_teacher.php`
- **Key Features:**
  - Assign subjects and classes.
  - Store email and contact details.
  - Secure CRUD operations.

### 4. Parent Management
- **Files:** `add_parent.php`, `edit_parent.php`, `view_parent.php`, `delete_parent.php`
- **Key Features:**
  - Link multiple children to one parent.
  - Store contact and relationship type.

### 5. Class Management
- **Files:** `add_class.php`, `edit_class.php`, `view_class.php`, `delete_class.php`
- **Key Features:**
  - Assign teachers.
  - Manage class capacities.
  - Store grade level & section.

## Common Features
- **CRUD Operations:** Add, edit, view, and delete records.
- **Prepared Statements:** Prevent SQL injection.
- **Dynamic Dropdowns:** Allow selecting teachers, parents, and classes.
- **Redirections:** Navigate users to the appropriate section after actions.


