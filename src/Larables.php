<?php

namespace JennosGroup\Larables;

class Larables
{
	/**
	 * The vendor directory name.
	 */
	protected static $vendorDirName = 'larables';

	/**
	 * The assets tag id.
	 */
	protected static $assetsTagId = 'larables-assets';

	/**
	 * The views tag id.
	 */
	protected static $viewsTagId = 'larables-views';

	/**
	 * The views id.
	 */
	protected static $viewsId = 'larables';

	/**
	 * Get the assets relative path.
	 */
	public static function assetsRelativePath(): string
	{
		return 'vendor/'.static::$vendorDirName;
	}

	/**
	 * Get the views relative path.
	 */
	public static function viewsRelativePath(): string
	{
		return 'views/vendor/'.static::$vendorDirName;
	}

	/**
	 * Get the assets tag id.
	 */
	public static function assetsTagId(): string
	{
		return static::$assetsTagId;
	}

	/**
	 * Get the views tag id.
	 */
	public static function viewsTagId(): string
	{
		return static::$viewsTagId;
	}

	/**
	 * Get the views id.
	 */
	public static function viewsId(): string
	{
		return static::$viewsId;
	}

	/**
	 * Set the vendor directory name.
	 */
	public static function setVendorDirName(string $name): void
	{
		static::$vendorDirName = $name;
	}

	/**
	 * Set the assets tag id.
	 */
	public static function setAssetsTagId(string $name): void
	{
		static::$assetsTagId = $name;
	}

	/**
	 * Set the views tag id.
	 */
	public static function setViewsTagId(string $name): void
	{
		static::$viewsTagId = $name;
	}

	/**
	 * Set the views id
	 */
	public static function setViewsId(string $name): void
	{
		static::$viewsId;
	}
}
