<?php
/**
 *
 *
 *
 * PHP versions 5
 *
 *
 *
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     %%your_name%% <%%your_email%%>
 * @copyright  %%your_project%%
 * @license    %%your_license%%
 * @version    GIT: $Id$
 * @link       %%your_link%%
 * @see        http://www.enviphp.net/c/man/v3/core/unittest
 * @since      File available since Release 1.0.0
 * @doc_ignore
 */


/**
 *
 *
 *
 *
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     %%your_name%% <%%your_email%%>
 * @copyright  %%your_project%%
 * @license    %%your_license%%
 * @version    GIT: $Id$
 * @link       %%your_link%%
 * @see        http://www.enviphp.net/c/man/v3/core/unittest
 * @since      File available since Release 1.0.0
 * @doc_ignore
 */
class JapaneseDate_VernalAutumnTest extends testCaseBase
{
    /**
     * +-- 初期化
     *
     * @access public
     * @return void
     */
    public function initialize()
    {
        $this->free();
    }
    /* ----------------------------------------- */

    /**
     * +--
     *
     * @access      public
     * @return      void
     * @covers         JapaneseDate\JapaneseDate::__construct
     * @covers         JapaneseDate\JapaneseDate::getVernalEquinoxDay
     */
    public function getVernalEquinoxDayTest()
    {
        $jd = new \JapaneseDate\JapaneseDate;
        $res = $jd->getVernalEquinoxDay(2151);$this->assertFalse    ($res);

        $res = $jd->getVernalEquinoxDay(1923);$this->assertEquals(date('d', $res), '22');
        $res = $jd->getVernalEquinoxDay(1925);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1926);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1927);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1928);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1929);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1930);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1931);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1932);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1933);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1934);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1935);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1936);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1937);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1938);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1939);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1940);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1941);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1942);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1943);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1944);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1945);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1946);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1947);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1948);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1949);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1950);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1951);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1952);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1953);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1954);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1955);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1956);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1957);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1958);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1959);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1960);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1961);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1962);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1963);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1964);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1965);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1966);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1967);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1968);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1969);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1970);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1971);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1972);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1973);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1974);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1975);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1976);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1977);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1978);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1979);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1980);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1981);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1982);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1983);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1984);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1985);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1986);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1987);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1988);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1989);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1990);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1991);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1992);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1993);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1994);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1995);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1996);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1997);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(1998);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(1999);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2000);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2001);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2002);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2003);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2004);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2005);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2006);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2007);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2008);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2009);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2010);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2011);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2012);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2013);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2014);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2015);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2016);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2017);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2018);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2019);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2020);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2021);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2022);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2023);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2024);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2025);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2026);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2027);$this->assertEquals(date('d', $res), '21');
        $res = $jd->getVernalEquinoxDay(2028);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2029);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2030);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2090);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2091);$this->assertEquals(date('d', $res), '20');
        $res = $jd->getVernalEquinoxDay(2150);$this->assertEquals(date('d', $res), '21');

    }
    /* ----------------------------------------- */



    /**
     * +--
     *
     * @access      public
     * @return      void
     * @covers         JapaneseDate\JapaneseDate::__construct
     * @covers         JapaneseDate\JapaneseDate::getAutumnEquinoxDay
     */
    public function getAutumnEquinoxDayTest()
    {
        $jd = new \JapaneseDate\JapaneseDate;
        $res = $jd->getAutumnEquinoxDay(2151);$this->assertFalse    ($res);

        $res = $jd->getAutumnEquinoxDay(1923);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1925);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1926);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1927);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1928);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1929);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1930);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1931);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1932);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1933);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1934);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1935);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1936);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1937);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1938);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1939);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1940);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1941);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1942);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1943);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1944);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1945);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1946);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1947);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1948);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1949);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1950);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1951);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1952);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1953);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1954);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1955);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1956);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1957);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1958);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1959);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1960);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1961);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1962);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1963);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1964);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1965);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1966);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1967);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1968);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1969);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1970);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1971);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1972);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1973);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1974);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1975);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1976);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1977);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1978);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1979);$this->assertEquals(date('d', $res), '24');
        $res = $jd->getAutumnEquinoxDay(1980);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1981);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1982);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1983);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1984);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1985);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1986);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1987);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1988);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1989);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1990);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1991);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1992);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1993);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1994);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1995);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1996);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1997);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1998);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(1999);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2000);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2001);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2002);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2003);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2004);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2005);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2006);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2007);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2008);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2009);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2010);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2011);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2012);$this->assertEquals(date('d', $res), '22');
        $res = $jd->getAutumnEquinoxDay(2013);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2014);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2015);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2016);$this->assertEquals(date('d', $res), '22');
        $res = $jd->getAutumnEquinoxDay(2017);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2018);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2019);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2020);$this->assertEquals(date('d', $res), '22');
        $res = $jd->getAutumnEquinoxDay(2021);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2022);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2023);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2024);$this->assertEquals(date('d', $res), '22');
        $res = $jd->getAutumnEquinoxDay(2025);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2026);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2027);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2028);$this->assertEquals(date('d', $res), '22');
        $res = $jd->getAutumnEquinoxDay(2029);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2030);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2090);$this->assertEquals(date('d', $res), '22');
        $res = $jd->getAutumnEquinoxDay(2091);$this->assertEquals(date('d', $res), '23');
        $res = $jd->getAutumnEquinoxDay(2150);$this->assertEquals(date('d', $res), '23');

    }
    /* ----------------------------------------- */



    /**
     * +-- 終了処理
     *
     * @access public
     * @return void
     */
    public function shutdown()
    {
    }

}
