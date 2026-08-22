<?php
namespace Ws2\Opcodes;

/**
 * 12 [string=name][NULL][byte * 2]
 */
class StartTimer extends AbstractOpcode
{
    public const OPCODE = '12';
    public const FUNC = 'StartTimer';

    public function decompile(\Helper\FastBuffer &$dataSource): self
    {
        [$name, $len] = $this->reader->readString($dataSource);
        $size = 2;
        if ($this->version > 2.1) {
            $size ++;
        }
        $config = $this->reader->readData($dataSource, $size);
        $this->compiledSize = 1 + $len + $size;

        $this->content = static::FUNC . " ({$name}, ".implode(', ', $config).")";
        return $this;
    }

    public function preCompile(?string $params = null): self
    {
        $params = $this->reader->unpackParams($params);

        $this->content = $this->reader->convertHexToChar(static::OPCODE) .
            $this->reader->packString($params[0]) .
            pack('cc', (int)$params[1], (int)$params[2]);
        if ($this->version > 2.1) {
            $this->content .= pack('c', (int)$params[3]);
        }
        return $this;
    }
}
