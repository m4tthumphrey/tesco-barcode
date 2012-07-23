<?php

class Tesco_Barcode
{
	protected $barcode = null;
	protected $product_code = null;
	protected $checksum = null;
	protected $price = 0;
	
	protected $_log = true;
	
	const DISCOUNT_CODE = 971;
	
	public static function scan($barcode)
	{
		return new Tesco_Barcode($barcode);
	}
	
	private function __construct($barcode)
	{
		$this->product_code = $barcode;
		
		$this->log('Original barcode is '.$this->product_code);
	}
	
	public function setPrice($price)
	{
		$this->price = $price;
		
		return $this;
	}
	
	public function getChecksum($char = null)
	{			
		!$char and $char = rand(0,9);
		
		$this->barcode = self::DISCOUNT_CODE.$this->product_code.$char.sprintf('%05d', $this->price).'0';
		
		$code		= $this->barcode;
		$even		= 0;
		$odd		= 0;
		
		$this->log('Discounted barcode is '.$code);
		
		for ($i = 0; $i <= strlen($code) - 1; $i++)
		{
			if ($i % 2 == 0)
			{
				$even += $code{$i};
				$this->log('Position '.$i.' (even) += ' . $code{$i});
			}
			else
			{
				$odd += $code{$i};
				$this->log('Position '.$i.' (odd) += ' . $code{$i});
			}			
		}
		
		$this->log('Odd is '.$odd);
		
		$even		*= 3;		
		$total	= $even + $odd;
		$mod		= $total % 10;
		
		$this->log('Odd is now '.$odd);
		$this->log('Even is '.$even);		
		$this->log('Total is '.$total);		
		$this->log('Modular is '.$mod);
		
		$checksum = 10 - $mod;
		
		$this->log('Checksum is '.$checksum);
		
		return $checksum;
	}
	
	public function getBarcode($char = null)
	{
		$checksum = $this->getChecksum($char);		
		
		return $this->barcode.$checksum;
	}
	
	public function setLog($log)
	{
		$this->_log = $log;
		
		return $this;
	}
	
	protected function log($message)
	{
		if ($this->_log) 
		{
			echo $message . '<br>';
		}
	}
}