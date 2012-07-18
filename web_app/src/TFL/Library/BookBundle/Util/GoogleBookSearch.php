<?php
namespace TFL\Library\BookBundle\Util;

/**
* This is a class to utilize the Google Book API and was modified from code written by Olivier Arteau
* 
* getBooksByKeyword
* 	- return an array of books
* 	
* getBookByISBN
* 	- return the book data, null if it does not exist
* 
* The structure of book data :
*
* array(
* 	'author' => '', // author(s) 
* 	'date' => 0, // Date published
* 	'identifier' => array(
* 		'ISBN' => '', // ISBN10
* 		'ISBN2' => '', // ISBN13 
* 		'googleid' => '' // Google Id of book
* 	),
* 	'title' => '', // Title of book
* 	'publisher' => '', // Publisher
* 	'description' => '', // Description
* 	'image' => '' // thumbnail
* );
* 
*/
class GoogleBookSearch {
	private $xpp;
	
	public function __construct() {
		
	}
	
	/**
	 * Search book(s) for keyword(s). Returns a list of books found with their information.
	 * 
	 * @param (string) keyword(s)
	 **/
	public function getBooksByKeyword($keyword) {
		$this->xpp = new \XMLReader();
		$books = array();
		
		if ($this->xpp->open('http://books.google.com/books/feeds/volumes?q=' . urlencode($keyword))) {
			$this->moveToEntry();
			$books = array();
			
			while ($this->xpp->name == "entry") {
				$books[] = $this->parseBook();
			}
		}
		
		return $books;
	}
	
	/**
	 * Look up a book by its ISBN and returns an array containing info about the book
	 * 
	 * @param (string) ISBN
	 **/
	public function getBookByISBN($isbn) {
		$this->xpp = new \XMLReader();
		
		if ($this->xpp->open('http://books.google.com/books/feeds/volumes?q=' . urlencode($isbn))) {
			$this->moveToEntry();
			
			$found = false;
			while ($this->xpp->name == "entry") {
				$book = $this->parseBook();
				
				// if book is found 
				if (isset($book['identifier']) &&
					(strlen($isbn) == 10 && isset($book['identifier']['ISBN']) &&  $book['identifier']['ISBN'] == $isbn) || // ISBN
					(strlen($isbn) == 13 && isset($book['identifier']['ISBN2']) &&  $book['identifier']['ISBN2'] == $isbn)) // ISBN2
				{
					$found = true;
					break;
				}
			}
		}
		
		return (!isset($book) || !$found) ? null : $book;
	}
	
	private function parseBook() {
		$book = array();
		$book['description'] = FALSE;
		$book['publisher'] = FALSE;
		$book['date'] = FALSE;
		
		while ($this->xpp->read() && $this->xpp->name != "entry") {
			if ($this->xpp->name{0} == "#")
				continue;
				
			switch($this->xpp->name) {
				case 'dc:creator':
					if (!isset($book['author']))
						$book['author'] = '';
					else
						$book['author'] .= ', ';
					$book['author'] .= $this->parseXMLData();
					break;
				case 'dc:date':
					$dt = explode('-', $this->parseXMLData());
					
					$book['date'] = mktime(0,0,0, (isset($dt[2]) ? $dt[2] : 1), (isset($dt[1]) ? $dt[1] : 1), $dt[0]);
					break;
				case 'dc:identifier':
					if (!isset($book['identifier'])) {
						$book['identifier'] = array();
						$book['identifier']['ISBN2'] = FALSE;
					}
					$dt = $this->parseIdentifier();
					$book['identifier'][$dt['type']] = $dt['data'];
					break;
				case 'dc:title':
					if (!isset($book['title']))
						$book['title'] = '';
					else
						$book['title'] .= ', ';
					$book['title'] .= $this->parseXMLData();
					break;
				case 'dc:publisher':
					$book['publisher'] = $this->parseXMLData();
					break;
				case 'dc:description':
					$book['description'] = $this->parseXMLData();
					break;
				case 'link' :
					$dt = $this->parseLink();
					
					if ($dt['name'] == 'thumbnail') {
						$book['image'] = $dt['href'];
					}
					break;
			}
		}
		
		$this->xpp->read();
		
		return $book;
	}

	private function parseXMLData() {
		$this->xpp->read();
		$val = $this->xpp->value;
		$this->xpp->read();
		return $val;
	}
	
	private function parseLink() {
		$dt = array();
		$dt['type'] = $this->xpp->getAttribute('type');
		$dt['name'] = substr($this->xpp->getAttribute('rel'), strrpos($this->xpp->getAttribute('rel'), '/') + 1);
		$dt['href'] = html_entity_decode($this->xpp->getAttribute('href'));
		
		return $dt;
	}
	
	private function parseIdentifier() {
		$this->xpp->read();
		$val = $this->xpp->value;
		$this->xpp->read();
		
		$dt = array();
		if (substr($val,0,5) == 'ISBN:') {
			$dt['type'] = 'ISBN';
			$dt['data'] = trim(substr($val,5));
			
			if (strlen($dt['data']) == 13)
				$dt['type'] .= '2';
		} else {
			$dt['type'] = 'googleid';
			$dt['data'] = $val;
		}
		
		return $dt;
	}

	/**
	 * Position xml pointer at "entry"
	 */
	private function moveToEntry() {
		while($this->xpp->name != "entry") {
			if (!$this->xpp->read())
				break;
		}
	}
}
