<?php

namespace Macghriogair\Support\Tests;

use Macghriogair\Support\Parser\KeywordParser;

class KeywordParserTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_translates_only_if_necessary()
    {
        $input = 'Finnische Akademie der Wissenschaften';

        $this->assertEquals('Finnische Akademie der Wissenschaften', KeywordParser::translate($input));
    }

    /** @test */
    public function it_builds_an_appendix()
    {
        $data = [
            '$PAbraham Ben-Samuel Zakut$lSalmanticensis' => 'Abraham Ben-Samuel Zakut <Salmanticensis>',
            'Osbert$nof Stoke' => 'Osbert <of Stoke>'
        ];

        $this->assertTranslations($data);
    }


    /** @test */
    public function it_handles_multiple_appendices()
    {
        $data = [
            '$PFridericus$lferratus' => 'Fridericus <ferratus>',
            '$PFridericus$nII.$lBrandenburg, Elector' => 'Fridericus <II., Brandenburg, Elector>',
            '$PFriedrich$nII.' => 'Friedrich <II.>',
            '$PThibaut$lde Marly$lHeiliger' => 'Thibaut <de Marly, Heiliger>',
            'Timotheusbrief$nI.$n3,2' => 'Timotheusbrief <I., 3,2>'
        ];

        $this->assertTranslations($data);
    }

    /** @test */
    public function it_replaces_with_whitespace()
    {
        $data = [
            'Finska Vetenskaps-Societeten$bHelsinki' => 'Finska Vetenskaps-Societeten Helsinki',
            'Finska Vetenskaps-Societeten$gHelsinki' => 'Finska Vetenskaps-Societeten Helsinki'
        ];

        $this->assertTranslations($data);
    }

    /** @test */
    public function it_replaces_with_slash()
    {
        $data = [
            'Bassompierre Sewrin, Charles-Augustin$cde' => 'Bassompierre Sewrin, Charles-Augustin / de',
            'Finska Vetenskaps-Societeten$xHelsinki' => 'Finska Vetenskaps-Societeten / Helsinki'
        ];
        $this->assertTranslations($data);
    }

    /** @test */
    public function it_replaces_non_latin_markers()
    {
        $input = '$T01 $UCyrl $PДавид$lНепобедимый';

        $this->assertEquals('Давид <Непобедимый>', KeywordParser::translate($input));
    }

    /** @test */
    public function it_strips_the_AT_character()
    {
        $data = [
            'Der @alte und der nuwe Parzefal' => 'Der alte und der nuwe Parzefal',
            'Le @mystère de saint Clément de Metz' => 'Le mystère de saint Clément de Metz',
            'Die @sieben weisen Meister$pProsa$pBearbeitung$pFrühneuhochdeutsch' => 'Die sieben weisen Meister'
        ];

        $this->assertTranslations($data);
    }

    /** @test */
    public function it_strips_the_percent_character()
    {
        $data = [
            'Krassovsky %1931, F. N.' => 'Krassovsky 1931, F. N.',
            'Martius %1517 u.ö., Galeottus' => 'Martius 1517 u.ö., Galeottus',
            'Arends %um 1860, Leopold A. F.' => 'Arends um 1860, Leopold A. F.',
            'Wolkonski %Fürst,, Ssergej' => 'Wolkonski Fürst,, Ssergej',
            'Fichte %1792-1879, G. A.' => 'Fichte 1792-1879, G. A.',
            'Kaucki %geb. 1854, Karl' => 'Kaucki geb. 1854, Karl',
            'Postl%wirkl. Name, Karl' => 'Postl wirkl. Name, Karl',
            'Žomini %Bn de, 1938, Anri' => 'Žomini Bn de, 1938, Anri',
            'Môrôʾā%hebr. Namensform, Andĕre' => 'Môrôʾā hebr. Namensform, Andĕre',
            'Benedictsson %[deutsche Namensform], Viktoria' => 'Benedictsson [deutsche Namensform], Viktoria',
            'Volgin %$q, V. P.' => 'Volgin, V. P.',
            'Fuzelier %$q, M.' => 'Fuzelier, M.'
        ];

        $this->assertTranslations($data);
    }

    private function assertTranslations($data)
    {
        foreach ($data as $input => $expected) {
            $this->assertEquals($expected, KeywordParser::translate($input));
        }
    }
}
