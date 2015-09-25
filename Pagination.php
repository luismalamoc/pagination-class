<?php

/**
 * Pagination
 *
 * This class contains the operations for the pagination.
 *
 * @author     Luis Alamo 
 */
class Pagination {

	/**
	 * all numbers rows of pagination.
	 *
	 * @var string
	 */
	private $num_rows;

	/**
	 * rows per page for the pagination.
	 *
	 * @var string
	 */
	private $rows_per_page;

	/**
	 * total pages for the pagination.
	 *
	 * @var string
	 */
	private $total_pages;

	/**
	 * current page into pagination.
	 *
	 * @var string
	 */
	private $current_page;

	/**
	 * make the pagination 
	 *
	 * @param int $num_rows
	 * @param int $_GET['per_page']
	 * @param int $_GET['current_page']
	 *
	 */
	public function make($num_rows, $row_per_page, $current_page)
	{
		$this->setNumRows($num_rows);
		$this->setRowsPerPage($row_per_page);
		$this->setTotalPages();
		$this->setCurrentPage($current_page);
	}

	/**
	 * sets numbers of rows
	 *
	 * @param int $num_rows
	 * @return void
	 *
	 */
	private function setNumRows($num_rows)
	{		
		$this->num_rows = $num_rows;		
	}

	/**
	 * sets rows per page
	 *
	 * @param int $rows_per_page
	 * @return void
	 *
	 */
	private function setRowsPerPage($rows_per_page)
	{
		if(isset($rows_per_page) and is_numeric($rows_per_page))
		{
			$this->rows_per_page = (int) $rows_per_page;
		}
		else
		{
			// default number of rows to show per page
			$this->rows_per_page = 10;
		}

		if($this->rows_per_page < 1)
		{
			$this->rows_per_page = 10;
		}
	}

	/**
	 * sets total of pages
	 *
	 * @return void
	 *
	 */
	private function setTotalPages()
	{
		$this->total_pages = ceil($this->num_rows / $this->rows_per_page);
	}

	/**
	 * sets current page
	 *
	 * @param int $current_page
	 * @return void
	 *
	 */
	private function setCurrentPage($current_page)
	{
		// get the current page or set a default
		if (isset($current_page) and is_numeric($current_page))
		{
			$this->current_page = (int) $current_page;
		}
		else
		{
			// default page number
			$this->current_page = 1; 
		}

		// if current page is greater than total pages
		if ($this->current_page > $this->total_pages) 
		{		
			// set current page to last page
			$this->current_page = $this->total_pages;
		}

		// if current page is less than first page
		if($this->current_page < 1)
		{
			$this->current_page = 1;
		}
	}

	/**
	 * gets the offset
	 *
	 * @return int
	 *
	 */
	public function getOffSet()
	{
		// the offset of the list, based on current page
		return ($this->current_page - 1) * $this->rows_per_page;
	}	

	/**
	 * gets the total pages
	 *
	 * @return int
	 *
	 */
	public function getTotalPages()
	{
		return $this->total_pages;
	}

	/**
	 * gets the rows per page
	 *
	 * @return int
	 *
	 */
	public function getRowsPerPage()
	{
		return $this->rows_per_page;
	}

	/**
	 * gets the current page
	 *
	 * @return int
	 *
	 */
	public function getCurrentPage()
	{
		return $this->current_page;
	}
	
}