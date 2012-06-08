<?php

/*
    Copyright (c) 2012, Open Source Solutions Limited, Dublin, Ireland
    All rights reserved.

    Contact: Barry O'Donovan - barry (at) opensolutions (dot) ie
             http://www.opensolutions.ie/

    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:

        * Redistributions of source code must retain the above copyright
          notice, this list of conditions and the following disclaimer.
        * Redistributions in binary form must reproduce the above copyright
          notice, this list of conditions and the following disclaimer in the
          documentation and/or other materials provided with the distribution.
        * Neither the name of Open Source Solutions Limited nor the
          names of its contributors may be used to endorse or promote products
          derived from this software without specific prior written permission.

    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
    ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
    WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
    DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
    (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
    LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
    ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
    (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
    SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

namespace OSS\SNMP\MIBS\Cisco;

/**
 * A class for performing SNMP V2 queries on Cisco devices
 *
 * @copyright Copyright (c) 2012, Open Source Solutions Limited, Dublin, Ireland
 * @author Barry O'Donovan <barry@opensolutions.ie>
 */
class VTP extends \OSS\SNMP\MIBS\Cisco
{


    const OID_VTP_VLAN_STATUS          = '.1.3.6.1.4.1.9.9.46.1.3.1.1.2.1';
    const OID_VTP_VLAN_TYPE            = '.1.3.6.1.4.1.9.9.46.1.3.1.1.3.1';
    const OID_VTP_VLAN_NAME            = '.1.3.6.1.4.1.9.9.46.1.3.1.1.4.1';


    const OID_STP_X_RSTP_PORT_ROLE     = '.1.3.6.1.4.1.9.9.82.1.12.2.1.3'; // add '.$VID'; integer


    /**
     * Constant for possible value of VTP VLAN status.
     * @see vlanStates()
     */
    const VTP_VLAN_STATE_OPERATIONAL = 1;

    /**
     * Constant for possible value of VTP VLAN status.
     * @see vlanStates()
     */
    const VTP_VLAN_STATE_SUSPENDED = 2;

    /**
     * Constant for possible value of VTP VLAN status.
     * @see vlanStates()
     */
    const VTP_VLAN_STATE_MTU_TOO_BIG_FOR_DEVICE = 3;

    /**
     * Constant for possible value of VTP VLAN status.
     * @see vlanStates()
     */
    const VTP_VLAN_STATE_MTU_TOO_BIG_FOR_TRUNK = 4;

    /**
     * Text representation of VTP VLAN status.
     *
     * @see vlanStates()
     * @var array Text representations of VTP VLAN status.
     */
    public static $VTP_VLAN_STATES = array(
        self::VTP_VLAN_STATE_OPERATIONAL            => 'operational',
        self::VTP_VLAN_STATE_SUSPENDED              => 'suspended',
        self::VTP_VLAN_STATE_MTU_TOO_BIG_FOR_DEVICE => 'mtuTooBigForDevice',
        self::VTP_VLAN_STATE_MTU_TOO_BIG_FOR_TRUNK  => 'mtuTooBigForTrunk'
    );

    /**
     * Get the device's VTP VLAN States (indexed by VLAN ID)
     *
     * @see $VTP_VLAN_STATES
     * @see VTP_VLAN_STATE_OPERATIONAL and others
     *
     * @param boolean $translate If true, return the string representation via self::$VTP_VLAN_TYPES
     * @return array The device's VTP VLAN States (indexed by VLAN ID)
     */
    public function vlanStates( $translate = false )
    {
        $states = $this->getSNMP()->walk1d( self::OID_VTP_VLAN_STATUS );

        if( !$translate )
            return $states;

        return $this->getSNMP()->translate( $states, self::$VTP_VLAN_STATES );
    }




    /**
     * Constant for possible value of VTP VLAN type.
     * @see vlanTypes()
     */
    const VTP_VLAN_TYPE_ETHERNET = 1;

    /**
     * Constant for possible value of VTP VLAN type.
     * @see vlanTypes()
     */
    const VTP_VLAN_TYPE_FDDI = 2;

    /**
     * Constant for possible value of VTP VLAN type.
     * @see vlanTypes()
     */
    const VTP_VLAN_TYPE_TOKEN_RING = 3;

    /**
     * Constant for possible value of VTP VLAN type.
     * @see vlanTypes()
     */
    const VTP_VLAN_TYPE_FDDI_NET = 4;

    /**
     * Constant for possible value of VTP VLAN type.
     * @see vlanTypes()
     */
    const VTP_VLAN_TYPE_TR_NET = 5;

    /**
     * Constant for possible value of VTP VLAN type.
     * @see vlanTypes()
     */
    const VTP_VLAN_TYPE_DEPRECATED = 6;

    /**
     * Text representation of VTP VLAN types.
     *
     * @see vlanTypes()
     * @var array Text representations of VTP VLAN types.
     */
    public static $VTP_VLAN_TYPES = array(
        self::VTP_VLAN_TYPE_ETHERNET    => 'ethernet',
        self::VTP_VLAN_TYPE_FDDI        => 'fddi',
        self::VTP_VLAN_TYPE_TOKEN_RING  => 'tokenRing',
        self::VTP_VLAN_TYPE_FDDI_NET    => 'fddiNet',
        self::VTP_VLAN_TYPE_TR_NET      => 'trNet',
        self::VTP_VLAN_TYPE_DEPRECATED  => 'deprecated'
    );

    /**
     * Get the device's VTP VLAN Types (indexed by VLAN ID)
     *
     * @see $VTP_VLAN_TYPES
     * @see VTP_VLAN_TYPE_ETHERNET and others
     *
     * @param boolean $translate If true, return the string representation via self::$VTP_VLAN_TYPES
     * @return array The device's VTP VLAN types (indexed by VLAN ID)
     */
    public function vlanTypes( $translate = false )
    {
        $types = $this->getSNMP()->walk1d( self::OID_VTP_VLAN_TYPE );

        if( !$translate )
            return $types;

        return $this->getSNMP()->translate( $types, self::$VTP_VLAN_TYPES );
    }

    /**
     * Get the device's VTP VLAN names (indexed by VLAN ID)
     *
     * @return array The device's VTP VLAN names (indexed by VLAN ID)
     */
    public function vlanNames()
    {
        return $this->getSNMP()->walk1d( self::OID_VTP_VLAN_NAME );
    }





    /**
     * Constant for possible value of STP extensions RSTP Port Role
     * @see stpxRstpPortRole()
     */
    const STP_X_RSTP_PORT_ROLE_DISABLED = 1;

    /**
     * Constant for possible value of STP extensions RSTP Port Role
     * @see stpxRstpPortRole()
     */
    const STP_X_RSTP_PORT_ROLE_ROOT = 2;

    /**
     * Constant for possible value of STP extensions RSTP Port Role
     * @see stpxRstpPortRole()
     */
    const STP_X_RSTP_PORT_ROLE_DESIGNATED = 3;

    /**
     * Constant for possible value of STP extensions RSTP Port Role
     * @see stpxRstpPortRole()
     */
    const STP_X_RSTP_PORT_ROLE_ALTERNATE = 4;

    /**
     * Constant for possible value of STP extensions RSTP Port Role
     * @see stpxRstpPortRole()
     */
    const STP_X_RSTP_PORT_ROLE_BACKUP = 5;

    /**
     * Constant for possible value of STP extensions RSTP Port Role
     * @see stpxRstpPortRole()
     */
    const STP_X_RSTP_PORT_ROLE_BOUNDARY = 6;

    /**
     * Constant for possible value of STP extensions RSTP Port Role
     * @see stpxRstpPortRole()
     */
    const STP_X_RSTP_PORT_ROLE_MASTER = 6;

    /**
     * Text representation of STP extensions RSTP Port Roles
     *
     * @see stpxRstpPortRole()
     * @var array Text representations of STP extensions RSTP Port Role.
     */
    public static $STP_X_RSTP_PORT_ROLES = array(
        self::STP_X_RSTP_PORT_ROLE_DISABLED    => 'disabled',
        self::STP_X_RSTP_PORT_ROLE_ROOT        => 'root',
        self::STP_X_RSTP_PORT_ROLE_DESIGNATED  => 'designated',
        self::STP_X_RSTP_PORT_ROLE_ALTERNATE   => 'alternate',
        self::STP_X_RSTP_PORT_ROLE_BACKUP      => 'backUp',
        self::STP_X_RSTP_PORT_ROLE_BOUNDARY    => 'boundary',
        self::STP_X_RSTP_PORT_ROLE_MASTER      => 'master'
    );


    /**
     * Get the device's RSTP port roles (by given vlan id)
     *
     * Only ports participating in RSTP for the given VLAN id are returned.
     *
     * This function will also convert STP port IDs to the device proper port IDs.
     * E.g. sample output:
     *
     * Array
     * (
     *    [10101] => 3
     *    [10103] => 3
     *    [10105] => 3
     *    [5048] => 2
     * )
     *
     *
     * @see $STP_X_RSTP_PORT_ROLES
     * @see STP_X_RSTP_PORT_ROLE_ROOT and others
     *
     * @param int $vid The RSTP VLAN ID to query port roles for
     * @param boolean $translate If true, return the string representation via self::$STP_X_RSTP_PORT_ROLES
     * @return array The device's RSTP port roles (by given vlan id)
     */
    public function rstpPortRole( $vid, $translate = false )
    {
        $roles = $this->getSNMP()->walk1d( self::OID_STP_X_RSTP_PORT_ROLE . ".{$vid}" );

        // convert STP port IDs to switch port IDs
        $croles = array();
        foreach( $roles as $k => $v )
            $croles[ $this->bridgeBasePortIfIndexes()[$k] ] = $v;

        if( !$translate )
            return $croles;

        return self::translate( $croles, self::$STP_X_RSTP_PORT_ROLES );
    }



}
