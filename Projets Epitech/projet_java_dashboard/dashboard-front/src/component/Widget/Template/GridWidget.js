import { SimpleGrid } from '@mantine/core';
import React from 'react';
import DeezerAlbum from '../DeezerAlbum';
import DeezerSearch from '../DeezerSearch';
import Github1 from '../Github1';
import Github2 from '../Github2';
import Gmail from '../Gmail';
import GmailSend from '../GmailSend';
import News0 from '../News0';
import News1 from '../News1';
import WeatherDay from '../WeatherDay';
import WeatherHourly from '../WeatherHourly';
import WidgetTemplate from './WidgetTemplate';

const GridWidget = () => {
    return (
        <div className='widget'>
            <SimpleGrid cols={2}>
            <WidgetTemplate> <WeatherDay /></WidgetTemplate>
            <WidgetTemplate> <WeatherHourly /></WidgetTemplate>
            <WidgetTemplate> <DeezerSearch /></WidgetTemplate>
            <WidgetTemplate> <DeezerAlbum /></WidgetTemplate>
            <WidgetTemplate> <News0 /></WidgetTemplate>
            <WidgetTemplate> <News1 /></WidgetTemplate>
            <WidgetTemplate> <Github1 /></WidgetTemplate>
            <WidgetTemplate> <Github2 /></WidgetTemplate>
            <WidgetTemplate> <Gmail /></WidgetTemplate>
            <WidgetTemplate> <GmailSend /></WidgetTemplate>

            </SimpleGrid>
        </div>
    );
};

export default GridWidget;