<?php
function getDateTime()
{
    // Get our time for updated_at
    $date = new DateTime("now", new DateTimeZone('Asia/Kolkata') );
    return $date->format('Y-m-d H:i:s');
}

function getAllData($conn , $table , $fields , $orderBy = '' , $where = '')
{
  $query  = "SELECT $fields FROM $table WHERE en_status = 'Active' $where $orderBy";
  $result = $conn->query($query);
  return $result ;
}


function getAllDataWC($conn , $table , $fields , $orderBy = '' , $where = '')
{
  $query  = "SELECT $fields FROM $table WHERE A.en_status = 'Active' $where $orderBy";
  $result = $conn->query($query);
  return $result ;
}


function getAllAtt($conn , $table , $fields , $orderBy = '' , $where = '')
{
  $query  = "SELECT $fields FROM $table WHERE A.en_status = 'Active' AND B.en_status = 'Active' $where $orderBy";
  $result = $conn->query($query);
  return $result ;
}

function getSiteName($conn , $ID)
{
  $query  = "SELECT vc_siteName FROM `tbl_site` WHERE int_siteId = '$ID'";
  $result = $conn->query($query);
  if($result && $result->num_rows > 0)
  {
      $rows = mysqli_fetch_assoc($result);
      return $rows['vc_siteName'];
  }
}

function getPlotName($conn , $ID)
{
  $query  = "SELECT vc_plotName FROM `tbl_plot` WHERE int_plotId = '$ID'";
  $result = $conn->query($query);
  if($result && $result->num_rows > 0)
  {
      $rows = mysqli_fetch_assoc($result);
      return $rows['vc_plotName'];
  }
  
}

function getSiteByPlot($conn , $ID)
{
  $query  = "SELECT A.* FROM `tbl_site` AS A JOIN `tbl_plot` AS B ON A.int_siteId = B.int_siteId  WHERE B.int_plotId = '$ID'";
  $result = $conn->query($query);
  if($result && $result->num_rows > 0)
  {
      $rows = mysqli_fetch_assoc($result);
      return $rows;
  }
  
}

function getPlotObj($conn , $ID)
{
  $query  = "SELECT * FROM `tbl_plot` WHERE int_plotId = '$ID'";
  $result = $conn->query($query);
  if($result && $result->num_rows > 0)
  {
      $rows = mysqli_fetch_assoc($result);
      return $rows;
  }
  
}

function checkData($conn , $table , $fields , $where)
{
  $query  = "SELECT $fields FROM $table WHERE $where AND en_status = 'Active'";
  $result = $conn->query($query);
  return $count = $result->num_rows;
}

function checkBOM($conn , $where)
{
  $query  = "SELECT * FROM tbl_bom WHERE $where AND en_status = 'Active'";
  $result = $conn->query($query);
  if($result)
  {
    return $result->num_rows;
  }
}

function getData($conn , $table , $fields , $where)
{
  $query  = "SELECT $fields FROM $table WHERE $where";
  
  $result = $conn->query($query);
  $row   = $result->fetch_assoc();
  return $row;
}

function deleteData($conn , $table , $where)
{
  $query  = "UPDATE $table SET en_status = 'Inactive' WHERE $where";
  $result = $conn->query($query);
}

function insertData($conn , $table , $fields , $values)
{
  $field = implode(',',$fields);
  $value = "'" . implode("','",$values) . "'"; 
  $query = "INSERT INTO $table ($field) VALUES($value)";

  if($conn->query($query))
    return 'success';
  else
    return 'fail';  
}

function updateData($conn , $table , $set , $where)
{
  $query  = "UPDATE $table SET  $set WHERE $where";
  $result = $conn->query($query);
  if($conn->query($query))
    return 'success';
  else
    return 'fail';  
}

function getAllDataWithLeftJoin($conn , $table , $fields , $leftjoin = '' , $where = '')
{
  //if($table == "tbl_purchasemaster a" ||  )
     $query  = "SELECT $fields FROM $table $leftjoin";
     
  // else 
    // $query  = "SELECT $fields FROM $table $leftjoin WHERE a.en_status = 'Active' $where ";

  $result = $conn->query($query);
  
  return $result ;
}

function getAllDataWithLeftJoins($conn , $table , $fields , $leftjoin = '' , $where = '')
{
  //if($table == "tbl_purchasemaster a" ||  )
    //  $query  = "SELECT $fields FROM $table $leftjoin";
     
  // else 
    $query  = "SELECT $fields FROM $table $leftjoin WHERE $where";

  $result = $conn->query($query);
  
  return $result ;
}


function updateLogTable($conn , $table , $userID, $userRole, $rowID)
{
    
    if (empty($userID) || empty($userRole) || empty($rowID))
    {
        return false;
    }
    
    //Get admin ids, and inserted or updated row ids.(All the values are comma seperated).
    $adminIds = getAdminIds($conn, $userID, $userRole);
    
    $date  = getDateTime();
    $query  = "INSERT INTO `logtable` (`tableName`, `userIds`, `rowIds`, `status`, `created_at`) 
            VALUES (
                '$table',
                '$adminIds',
                '$rowID',
                'Active',
                '$date'
            )";
    
    if($conn->query($query))
    {
        // $result = $conn->query($query);   
    }
    else
    {
        //echo $conn->error;die;
    }
     
}


function getAdminIds($conn, $Id, $userRole)
{
    $where = '';
    
    if ($userRole == "Project Manager")
    {
        $where = " AND en_role<>'Project Manager' ";
    }
    
    $query = "SELECT int_adminId FROM `tbl_admin` WHERE isMobileLogin = 'Yes' $where ORDER BY int_adminId";
    
    $result = $conn->query($query);
    $arr = [];
    while($rows = mysqli_fetch_assoc($result))
    {
        // We ignore the inserted admin id.
        if ($Id =='1' || $Id != $rows['int_adminId'])
        {
            $arr [] = $rows['int_adminId'];
        }
    }
    
    $values = implode(',', $arr);
    return $values;
}


?>
