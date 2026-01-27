<?php

declare(strict_types=1);

namespace Ofx\Header;

/**
 * Interface for OFX headers (v1 and v2).
 *
 * Both OFX versions have a header that precedes the message body.
 * This interface provides common access to header properties using PHP 8.4 property hooks.
 */
interface Header
{
    /**
     * OFX version number.
     *
     * Common values:
     * - 102, 151, 160 (OFXv1)
     * - 200, 201, 202, 203, 210, 211, 220 (OFXv2)
     */
    public int $version { get; }

    /**
     * Security type ('NONE' or 'TYPE1').
     */
    public string $security { get; }

    /**
     * Old file UID for file-based synchronization.
     */
    public string $oldFileUid { get; }

    /**
     * New file UID for file-based synchronization.
     */
    public string $newFileUid { get; }

    /**
     * PHP-compatible charset name (e.g., 'UTF-8', 'ISO-8859-1').
     */
    public string $encoding { get; }

    /**
     * Check if this is an OFX version 1 (SGML) header.
     */
    public bool $isVersion1 { get; }

    /**
     * Check if this is an OFX version 2 (XML) header.
     */
    public bool $isVersion2 { get; }
}
