
<?php

    $xmldoc = new DomDocument('1.0', 'utf-8');
    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

    $category = "History";
    $lang = "fr";
    $title = "Canadian history";
    $author = "some person";
    $year = "2015";
    $price = "25";

    //attempt to open the book.xm file
    if( $xml = file_get_contents( 'books.xml') ) {
        $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );

        // find the root bookstore tag
        $root = $xmldoc->getElementsByTagName('bookstore')->item(0);

        // create a new  <book> tag and assign it an attribute
        $book = $xmldoc->createElement('book');
        $categoryAttribute = $xmldoc->createAttribute("category");
        $categoryAttribute -> value = $category;
        $book->appendChild($categoryAttribute);

        // add the book tag created above before the first element in the <bookstore> tag
        $root->insertBefore( $book, $root->firstChild );

        // create other elements and add it to the <book> tag.
        $nameElement = $xmldoc->createElement('title');
        $book->appendChild($nameElement);
        $nameText = $xmldoc->createTextNode($title);
        $langAttribute = $xmldoc->createAttribute("lang");
        $langAttribute -> value = $lang;
        $nameElement->appendChild($nameText);
        $nameElement->appendChild($langAttribute);
        

        $authorElement = $xmldoc->createElement('author');
        $book->appendChild($authorElement);
        $authorText = $xmldoc->createTextNode($author);
        $authorElement->appendChild($authorText);

        $yearElement = $xmldoc->createElement('year');
        $book->appendChild($yearElement);
        $yearText = $xmldoc->createTextNode($year);
        $yearElement->appendChild($yearText);
        
        $priceElement = $xmldoc->createElement('price');
        $book->appendChild($priceElement);
        $priceText = $xmldoc->createTextNode($price);
        $priceElement->appendChild($priceText);

        //save all the new changes
        $xmldoc->save('books.xml');
        
    } else {
        
        echo "No file called books.xml was found";
    }
   
    //code block allows parts of an xml document, specified by the Xpath, to be written to a web page
    $xmlFile = simplexml_load_file('books.xml');
    $dom = new DOMDocument( '1.0', 'utf-8' );
    $dom ->loadXML($xmlFile);
    $book = $dom->getElementsByTagName('book');
    
    //read from an xml file and display on page
    echo "first book title in list:"." <br>";
    echo $xmlFile ->book[0]->title[0]."<br><br>";
    
    echo "All book titles in list:<br>";
    foreach($xmlFile ->book as $book){
        echo $book->title."<br>";
    }
    

?>