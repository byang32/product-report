<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Minisworld Product Report - Bee Yang</title>
 
        <link href="css/prodRep.css" rel="stylesheet">
 
    </head>
    <body>
        <?php
 
        $myForm = <<<MYFORM
        <div class="myForm">
 
            <h2>Minisworld Company Product Report</h2>
 
            <form action="$_SERVER[PHP_SELF]" method="post">
 
                <label for="fName">First Name:</label>
                <input type="text" name="fName" id="fName" size="20">
                <br><br>
 
                <label for="lName">Last Name:</label>
                <input type="text" name="lName" id="lName" size="20">
                <br><br>
 
                <label for="choices">Product Report Choices</label><br>
                <select name="choices[]" multiple>
                    <option value="figs" selected="yes">Painted Figures</option>
                    <option value="scenery">Town Square Scenery</option>
                    <option value="supplies">Misc Scenic Supplies</option>
                </select>
                <br><br>
 
                <input type="submit" name="go" id="go" value="Generate Product Report">
 
            </form>
 
        </div>
MYFORM;
 
        //
        // Decide if we should display the form OR the resulting product report page
        //
        if (!isset($_POST['go'])) {   // form was NOT submitted, so display form
            // display the form here
            print $myForm;
        }
        else {   // else form was submitted, process and display selected product's reports
 
            if (isset($_POST['fName'])) {
                $fName = $_POST['fName'];
            }
            else {
                $fName = "";
            }
 
            if (isset($_POST['lName'])) {
                $lName = $_POST['lName'];
            }
            else {
                $lName = "";
            }
 
            // greet user here as an <h2> using both first and last name from form
            // hint: you will need to use a span tag with an id value already set up in
            // your .css file
            print "<h2>"."<span>" . "Welcome " . $fName . $lName . "</span>"."</h2>";
      
 
            // Step through all selected product categories - no change needed here
            if (isset($_POST['choices'])) {
                $choices = $_POST['choices'];   // shortcut
            }
            else {
                $choices = "";
            }
 
            // check if user did NOT select a product category
            if ($choices === "") {
                print "\t<h2>No product categories were chosen</h2>\n\n";
 
                // now, redisplay the form
                print $myForm;
            }
            else {  // user selected at least one category
 
                $productCount = array();
 
                // associate report name with our categories
                $reportName["figs"] = "Painted Figures";
                $reportName["scenery"] = "Town Square Scenery";
                $reportName["supplies"] = "Misc Scenic Supplies";
 
                // open and read file containing product category descriptive names
                // assigning each category name as a key in the $productCount
                // associative array - store the returned file pointer in $fp
 
                $fp = fopen("prodCategories.txt", "r") or die("Unable to open file!");
 
                while(!feof($fp)) {
                  $line = rtrim(fgets($fp));
 
                  if ($line) {
                    $productCount[$line] = 0;
                  }
                }
 
 
                // Use a while loop to read each line in the product category file and store
                // each line in a variable named $category and remove any trailing \n
                // from $category.  If the line contains valid data, store a zero in an
                // element of the $productCount array whose key is the category name.
 
 
 
 
 
 
 
 
                // Set default timezone
                date_default_timezone_set('America/Chicago');
 
                // loop through the selected categories from the form and produce a heading
                // and a table for each of them - use a foreach loop and store the value
                // from each element of the selected choices from the form in a variable
                // named $inputFileName.
                foreach ($choices as $choice) {
 
 
 
 
 
                    // generate report header for this category using your $reportName
                    // array and generate the current year (4 digits) using PHP's date() function.
                    // Replace the areas in the output below with the ***'s.
                    print "\t<h2>" . $reportName[$choice] . " Product Report for " . date("Y") . "</h2>\n\n";
 
 
                    // obtain product info for all products in this selected category
                    // and display info for each product on its row of a table
                    print "\t<div class=\"ieCenter\">\n\n";
                    print "\t<table>\n";
 
                    // open the input file associated with this selected category and store
                    // returned file pointer in $fp
                    $fp = fopen($choice, "r");
 
                    if ($fp) {
 
 
 
                    // Read each line from the opened file using a while loop until you
                    // reach end-of-file storing each line in a variable named $product.
                    // Be sure to remove any trailing \n character.
                            // while not EOF
              while(!feof($fp)) {
 
                        // read next line
                        $line = rtrim(fgets($fp));
 
                        if ($line) {  // we have a valid product
 
                            // increment this category's product count in the $productCount array
                            $productCount[$reportName[$choice]]++;
 
                            // break up the line into its individual field values storing
                            // them from left-to-right in variables named: $productID, $numSold,
                            // $price, $numAvail, $cost, $desc, and $imgPath.
                            list($productID, $numSold, $prie, $numAvail, $cost, $desc, $imgPath) = explode(":", $line);
 
                            // generate table row for this product's info by jumping out
                            // of PHP delimiters...
                            ?>
 
                 <tr>
 
                     <!-- first column -->
                     <td>
 
                         <blockquote>
                             Item description:<br>
                             <strong><?php print $desc; ?></strong>
                             <br><br>
                             Part Number = <strong><?php print $productID; ?></strong>
                         </blockquote>
 
                     </td>
 
                     <!-- second column -->
                     <td>
 
                         <img src=<?php print $imgPath;?>
 
                     </td>
 
                     <!-- third column -->
                     <td>
 
 
 
 
 
                     </td>
 
                 </tr>
 
                            <?php
                        }  // end if we have a valid product
 
                      // end while not EOF
                    }
 
                    print "\t</table>\n";
                    print "\t</div>\n\n";
 
                    // end foreach selected category
                  }
                }
                // Display a bulleted list of product categories showing
                // number of products in each selected category.  Use a foreach
                // loop to step through this associative array obtaining both the
                // key ($categoryName) and value ($numProducts) for each element in the array.
                print "\t<div>\n\n";
 
             
                foreach ($productCount as $categoryName => $numProducts) {
                      print "<p>$categoryName = $numProducts</p>";
                      
                }
 
                print "\t<div>\n\n";
              
 
 
 
            }  // end else user selected at least one category
 
 
        }  // end else form was submitted
 
        ?>
 
        <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script src="supportData/js/fadePic.js"></script>
    </body>
</html>