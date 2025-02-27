<?php

namespace Ankas\DellinTerminalsWithoutApi;

use Ankas\DellinTerminalsWithoutApi\Exceptions\ParseTerminalsDataException;

class TerminalsGetter
{
    protected const TERMINALS_DATA_PATH = '../data/Terminals.json';
    protected ?array $citiesTerminalsData = null;

    public function __construct(protected bool $cacheTerminalsData = true) {}

    /**
     * Get teriminals by city KLADR code
     *
     * @param string $code
     * @return array|null
     */
    public function getTerminalsByCode(string $code): ?array
    {
        $citiesTerminalsData = $this->getCitiesTerminalsData();
        foreach ($citiesTerminalsData as $cityTerminalsData) {
            if ($cityTerminalsData['code'] === $code) {
                return ['terminals' => $cityTerminalsData['terminals']['terminal']];
            }
        }
        return null;
    }

    /**
     * Parse terminals data file and return it as array
     *
     * @return array
     */
    protected function getCitiesTerminalsData(): array
    {
        if ($this->citiesTerminalsData === null) {
            $citiesTerminalsDataContent = file_get_contents(static::TERMINALS_DATA_PATH);
            if ($citiesTerminalsDataContent === false) {
                throw new ParseTerminalsDataException('Cannot read terminals data file');
            }
            $citiesTerminalsData = json_decode($citiesTerminalsDataContent, true);
            if ($this->cacheTerminalsData) {
                $this->citiesTerminalsData = $citiesTerminalsData;
            }
            return $citiesTerminalsData;
        } else {
            return $this->citiesTerminalsData;
        }
    }
}
