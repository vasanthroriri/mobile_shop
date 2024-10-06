

                <!-- Brand Logo Light -->
                <a href="index.php" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="assets/images/logo.png" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="small logo">
                    </span>
                </a>

                <!-- Brand Logo Dark -->
                <a href="index.php" class="logo logo-dark bg-white">
                    <span class="logo-lg bg-white">
                        <img src="assets/images/logo.png"  alt="dark logo"  width="100%" height="70px">
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="small logo">
                    </span>
                </a>
                <!-- Full Sidebar Menu Close Button -->
                <div class="button-close-fullsidebar">
                    <i class="ri-close-fill align-middle"></i>
                </div>

                <!-- Sidebar -left -->
                <div class="h-100" id="leftside-menu-container" data-simplebar>
                    

                    <!--- Sidemenu -->
    <ul class="side-nav sidebar">

    <li class="side-nav-item">
    <a href="dashboard.php" class="side-nav-link">
        <i class="ri-bar-chart-2-fill"></i>
        <span> Dashboard</span>
    </a>
    </li> 
    <?php if ($user_role == 'Admin') { ?>
    <li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
        <i class="bi bi-person-vcard"></i>
        <span> Master </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="sidebarEmail">
        <ul class="side-nav-second-level">
            <!-- <li>
                <a href="masterStaff.php" class="side-nav-link"><i class="bi bi-person-bounding-box"></i>Staff</a>
            </li>
            <li>
                <a href="masterUniversity.php" class="side-nav-link"><i class="bi bi-buildings"></i>University</a>
            </li> -->
<!--             
            <li>
                <a href="course.php" class="side-nav-link"><i class="bi bi-ui-radios-grid"></i><span>Courses Details</span></a>
            </li> -->
            <!-- <li>
                <a href="electiveSubject.php" class="side-nav-link"><i class="bi bi-list-stars"></i><span>Elective Subject </span></a>
            </li> -->
            <!-- <li>
                <a href="masterSubject.php" class="side-nav-link"><i class="bi bi-list-columns-reverse"></i>Subject</a>
            </li> -->
            <li>
                <a href="brand.php" class="side-nav-link"><i class="bi bi-currency-rupee"></i>Brand</a>
            </li>
            <li>
                <a href="product.php" class="side-nav-link"><i class="bi bi-boxes"></i>Product</a>
            </li>
            <li>
                <a href="stock.php" class="side-nav-link"><i class="bi bi-graph-up-arrow"></i>Stock</a>
            </li>
            <li>
                <a href="bill.php" class="side-nav-link"><i class="bi bi-list-stars"></i><span>Bill </span></a>
            </li>
            
            <li>
                <a href="model.php" class="side-nav-link"><i class="bi bi-book"></i>Model</a>
            </li>
        </ul>
    </div>
    </li>

    <li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#transactionMenu" aria-expanded="false" aria-controls="transactionMenu" class="side-nav-link">
    <i class="bi bi-currency-bitcoin"></i>
        <span> Income / Expense </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="transactionMenu">
        <ul class="side-nav-second-level">
            
        
            <li>
                <a href="transaction.php" class="side-nav-link"><i class="bi bi-list-columns-reverse"></i>Transaction</a>
            </li>
            <li>
                <a href="fees.php" class="side-nav-link"><i class="bi bi-currency-rupee"></i>Fees</a>
            </li>
            
            <!-- <li>
                <a href="masterBooks.php" class="side-nav-link"><i class="bi bi-book"></i>Books</a>
            </li> -->
        </ul>
    </div>
    </li>

    <?php } ?>

    
    <?php if ($user_role == 'Staff') { ?>
        <li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#StaffMaster" aria-expanded="false" aria-controls="StaffMaster" class="side-nav-link">
        <i class="bi bi-person-vcard"></i>
        <span> Master </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="StaffMaster">
        <ul class="side-nav-second-level">
             <!-- <li>
                <a href="masterStaff.php" class="side-nav-link"><i class="bi bi-person-bounding-box"></i>Staff</a>
            </li> -->
            <li> 
                <a href="masterUniversity.php" class="side-nav-link"><i class="bi bi-buildings"></i>University</a>
            </li>
            <!-- <li>
                <a href="masterCourse.php" class="side-nav-link"><i class="bi bi-ui-radios-grid"></i>Course</a>
            </li> -->
            <li>
                <a href="course.php" class="side-nav-link"><i class="bi bi-ui-radios-grid"></i><span>Courses Details</span></a>
            </li>
            <li>
                <a href="electiveSubject.php" class="side-nav-link"><i class="bi bi-list-stars"></i><span>Elective Subject </span></a>
            </li>
            <li>
                <a href="masterSubject.php" class="side-nav-link"><i class="bi bi-list-columns-reverse"></i>Subject</a>
            </li>
            <!-- <li>
                <a href="masterBooks.php" class="side-nav-link"><i class="bi bi-book"></i>Books</a>
            </li> -->
        </ul>
    </div>
    </li>
    

    <li class="side-nav-item">
    <a href="enquiry.php" class="side-nav-link">
    <i class="bi bi-layout-three-columns"></i>
        <span> Enquiry </span>
    </a>
    </li>
<!-- <li class="side-nav-item">
    <a href="listUniversity.php" class="side-nav-link">
    <i class="bi bi-buildings"></i>
        <span> University </span>
    </a>
</li> -->
<li class="side-nav-item">
    <a href="admission.php" class="side-nav-link">
    <i class="bi bi-ui-checks"></i>
        <span> Admission </span>
    </a>
</li>

<!-- <li class="side-nav-item">
    <a href="course.php" class="side-nav-link">
    <i class="bi bi-ui-radios-grid"></i>
        <span> Courses Details </span>
    </a>
</li> -->
<!-- <li class="side-nav-item">
    <a href="masterSubject.php" class="side-nav-link">
    <i class="bi bi-list-columns-reverse"></i>
        <span>Subject </span>
    </a>
</li> -->

<li class="side-nav-item">
    <a href="fees.php" class="side-nav-link">
    <i class="bi bi-currency-rupee"></i>
        <span> Fees </span>
    </a>
</li>
<li class="side-nav-item">
    <a href="transaction.php" class="side-nav-link">
    <i class="bi bi-currency-exchange"></i>
        <span> Transaction </span>
    </a>
</li>

<!-- <li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#sidebarBook" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
        <i class="bi bi-person-vcard"></i>
        <span> Books </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="sidebarBook">
        <ul class="side-nav-second-level">
            <li>
                <a href="bookStock.php" class="side-nav-link"><i class="bi bi-stack"></i>Stock</a>
            </li>
            <li>
                <a href="bookIssue.php" class="side-nav-link"><i class="bi bi-journal-check"></i>Issue</a>
            </li>
        </ul>
    </div>
</li> -->
<li class="side-nav-item">
    <a href="bookIssue.php" class="side-nav-link">
    <i class="bi bi-stack"></i>
        <span> Books </span>
    </a>
</li>
<li class="side-nav-item">
    <a href="faculty.php" class="side-nav-link">
    <i class="bi bi-person-video3"></i>
        <span> Faculty </span>
    </a>
</li>
<li class="side-nav-item">
    <a href="schedule.php" class="side-nav-link">
    <i class="bi bi-calendar2-week"></i>
        <span> Schedule </span>
    </a>
</li>
<li class="side-nav-item">
    <a href="dailyReport.php" class="side-nav-link">
    <i class="bi bi-explicit"></i>
        <span> Daily Report </span>
    </a>
</li>
<?php } ?>

<?php if ($user_role == 'Admin') { ?>
    <li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#sidebarReport" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
        <i class="bi bi-person-vcard"></i>
        <span> Report </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="sidebarReport">
        <ul class="side-nav-second-level">
            <!-- <li>
                <a href="reportBook.php" class="side-nav-link"><i class="bi bi-sliders"></i>Book Reports</a>
            </li> -->
            <!-- <li>
                <a href="reportPending.php" class="side-nav-link"><i class="bi bi-sliders"></i>Book Pending</a>
            </li> -->
            <!-- <li>
                <a href="reportSchedule.php" class="side-nav-link"><i class="bi bi-calendar2-week"></i>Schedule</a>
            </li> -->
            <li>
                <a href="reportIncome.php" class="side-nav-link"><i class="bi bi-currency-rupee"></i>Income</a>
            </li>
            <li>
                <a href="reportTransaction.php" class="side-nav-link"><i class="bi bi-sign-intersection-t-fill"></i>Transaction</a>
            </li>

         
            <!-- <li>
                <a href="reportStaff.php" class="side-nav-link"><i class="bi bi-person-bounding-box"></i>Staff</a>
            </li>
            <li>
                <a href="reportFaculty.php" class="side-nav-link"><i class="bi bi-person-video3"></i>Faculty</a>
            </li> -->
        </ul>
    </div>
    </li>
    <?php } ?>
</ul>
                    <!--- End Sidemenu -->

                    <div class="clearfix"></div>
                    
                </div>
        
            <!-- ========== Left Sidebar End ========== -->
