<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Proxy\V1\Service\Session;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class InteractionOptions {
    /**
     * @param string $inboundParticipantStatus The inbound_participant_status
     * @param string $outboundParticipantStatus The outbound_participant_status
     * @return ReadInteractionOptions Options builder
     */
    public static function read($inboundParticipantStatus = Values::NONE, $outboundParticipantStatus = Values::NONE) {
        return new ReadInteractionOptions($inboundParticipantStatus, $outboundParticipantStatus);
    }
}

class ReadInteractionOptions extends Options {
    /**
     * @param string $inboundParticipantStatus The inbound_participant_status
     * @param string $outboundParticipantStatus The outbound_participant_status
     */
    public function __construct($inboundParticipantStatus = Values::NONE, $outboundParticipantStatus = Values::NONE) {
        $this->options['inboundParticipantStatus'] = $inboundParticipantStatus;
        $this->options['outboundParticipantStatus'] = $outboundParticipantStatus;
    }

    /**
     * The inbound_participant_status
     * 
     * @param string $inboundParticipantStatus The inbound_participant_status
     * @return $this Fluent Builder
     */
    public function setInboundParticipantStatus($inboundParticipantStatus) {
        $this->options['inboundParticipantStatus'] = $inboundParticipantStatus;
        return $this;
    }

    /**
     * The outbound_participant_status
     * 
     * @param string $outboundParticipantStatus The outbound_participant_status
     * @return $this Fluent Builder
     */
    public function setOutboundParticipantStatus($outboundParticipantStatus) {
        $this->options['outboundParticipantStatus'] = $outboundParticipantStatus;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Proxy.V1.ReadInteractionOptions ' . implode(' ', $options) . ']';
    }
}