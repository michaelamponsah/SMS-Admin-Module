
<!-- ******************************************************************************************************************************* -->

    <div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block sidebar" style="background: #333f4b;">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="admin.php">
              <i class="fas fa-cogs"></i>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#showHiddenStudents-links">
            <i class="fas fa-user-graduate" ></i>
              Students
            </a>
            <div class="collapse" id="showHiddenStudents-links">
            <a class="nav-link" href="./admin_admissions_2.php">
              Admissions Area
            </a>
            <a class="nav-link" href="./admin_students.php">
              View Students
            </a>
            </div>
          </li>


          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#showHiddenTeachers-links">
            <i class="fas fa-chalkboard-teacher"></i>
              Teachers
            </a>
            <div class="collapse" id="showHiddenTeachers-links">
            <a class="nav-link" href="./admin_employment.php">
              Employ Staff 
            </a>
            <a class="nav-link" href="./admin_teachers.php">
              View | Edit Teacher Details
            </a>
            </div>
          </li>


          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#showHiddenParents-links">
             <i class="fas fa-user"></i>
              Parents
            </a>
            <div class="collapse" id="showHiddenParents-links">
            <a class="nav-link" href="./admin_admissions_1.php">
              <span data-feather="file"></span>
              Add Parents
            </a>
            <a class="nav-link" href="./admin_parents.php">
              View Parents
            </a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="./add_user.php">
            <i class="fas fa-user-plus"></i>
              Add | Create Admin
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#assign-class-sub">
            <i class="fas fa-arrow-circle-right"></i>
             Assign classes | subject
            </a>
            <div class="collapse" id="assign-class-sub">
             
              <a href="admin_assign_class_subject.php" class="nav-link" id="clickToAssignSubject">Assign subjects to teacher</a>
              <!--<a href="" class="nav-link" id="clickToMakeClassTr">Make class teachers</a>

               <a href="admin_assign_class_subject.php" class="nav-link" id="clickToMakeClassTr" class="nav-link">Make class teachers</a>-->
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="./admin_add_class_subject.php">
            <i class="fas fa-plus-square"></i>
             Add classes | subject
            </a>
          </li>
          
        </ul>
      </div>
    </nav>
   
