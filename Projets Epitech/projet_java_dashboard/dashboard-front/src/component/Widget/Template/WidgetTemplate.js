import React from 'react';
import { Card, Image } from '@mantine/core';


const WidgetTemplate = (props) => {
    return (
            <Card shadow="md" p="lg" radius="lg" withBorder className='template'>
                
                <Image
                    right
                    src="https://img.icons8.com/ios-glyphs/480/null/settings--v1.png"
                    height={25}
                    width={25}
                    alt="settings" />
                {props.children}
            </Card>
    );
};

export default WidgetTemplate;