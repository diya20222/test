<?php namespace Folour\Flavy\Extensions;

/**
 *
 * @author Vadim Bova <folour@gmail.com>
 * @link   http://github.com/folour | http://vk.com/folour
 *
 */

class Base extends Commands
{

    /**
     *
     * Flavy config
     *
     * @var array
     */
    protected $config = [
        'ffmpeg_path'   => 'ffmpeg',
        'ffprobe_path'  => 'ffprobe'
    ];

    /**
     *
     * FFmpeg information
     *
     * @var array
     */
    private $_info = [
        'formats'   => [],

        'encoders'  => [
            'audio' => [],
            'video' => []
        ],

        'decoders'  => [
            'audio' => [],
            'video' => []
        ]
    ];

    /**
     * Base constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = array_replace($this->config, $config);
    }

    /**
     *
     * Returns array of supported formats
     *
     * @return array
     */
    public function formats()
    {
        if($this->_info['formats'] === null) {
            $data = $this->runCmd('get_formats', [$this->config['ffmpeg_path']]);
            if(is_array($data)) {
                $this->_info['formats'] = array_combine($data['format'], $data['mux']);
            }
        }

        return $this->_info['formats'];
    }

    /**
     *
     * Returns array of audio and video encoders
     * [
     *     'audio' => [],
     *     'video' => []
     * ]
     *
     * @return array
     */
    public function encoders()
    {
        if($this->_info['encoders']['audio'] === []) {
            $data = $this->runCmd('get_encoders', [$this->config['ffmpeg_path']]);
            if(is_array($data)) {
                foreach($data['type'] as $key => $type) {
                    $this->_info['encoders'][($type == 'A' ? 'audio' : 'video')][] = $data['format'][$key];
                }
            }
        }

        return $this->_info['encoders'];
    }

    /**
     *
     * Returns array of audio and video decoders
     * [
     *     'audio' => [],
     *     'video' => []
     * ]
     *
     * @return array
     */
    public function decoders()
    {
        if($this->_info['decoders']['audio'] === []) {
            $data = $this->runCmd('get_decoders', [$this->config['ffmpeg_path']]);
            if(is_array($data)) {
                foreach($data['type'] as $key => $type) {
                    $this->_info['decoders'][($type == 'A' ? 'audio' : 'video')][] = $data['format'][$key];
                }
            }
        }

        return $this->_info['decoders'];
    }

    /**
     * @param string $format
     * @return bool
     */
    public function canEncode($format)
    {
        return in_array($format, array_flatten($this->encoders()));
    }

    /**
     * @param string $format
     * @return bool
     */
    public function canDecode($format)
    {
        return in_array($format, array_flatten($this->decoders()));
    }

    //Helpers

    /**
     * @param int|string $time timestamp for conversion
     * @param bool $isDate mode flag, if true - $time converts from hh::mm:ss string to seconds, else conversely
     * @return string
     */
    protected function timestamp($time, $isDate = true)
    {
        if($isDate) {
            $time = explode(':', $time);

            return ($time[0] * 3600) + ($time[1] * 60) + (ceil($time[2]));
        }

        return gmdate('H:i:s', mktime(0, 0, $time));
    }
}