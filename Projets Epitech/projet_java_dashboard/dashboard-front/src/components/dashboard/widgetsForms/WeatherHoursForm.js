import { useForm } from '@mantine/form';

import { Button, Center, TextInput, NumberInput } from '@mantine/core';
import WeatherHoursWidget from '../widgets/WeatherHoursWidget';

const WeatherHoursForm = ({widgetType, defaultParams, onWidgetAdded, onWidgetUpdated}) => {
  const form = useForm({
    initialValues: {
      city: defaultParams ? defaultParams.city : '',
      timer: defaultParams ? defaultParams.timer : 60.0,
    },
  
    validate: {
      city: value => (
        /^[a-zA-Z\u0080-\u024F]+(?:([\ \-\']|(\.\ ))[a-zA-Z\u0080-\u024F]+)*$/
        .test(value) ? null : 'Invalid city'
      ),
    }
  });

  const onFormSumbitValidated = (values) => {
    const timer = values.timer;
    delete values.timer;

    if (defaultParams)
      onWidgetUpdated(timer, values);
    else
      onWidgetAdded(widgetType, timer, <WeatherHoursWidget />, values);
  }

  return (
    <form onSubmit={form.onSubmit(values => onFormSumbitValidated(values))}>
      <TextInput
        withAsterisk
        required={true}
        label='City name'
        placeholder='Paris, Tokyo...'
        {...form.getInputProps('city')}
      />
      <NumberInput
        withAsterisk
        required={true}
        label='Relaod time'
        description='Seconds'
        min={0}
        {...form.getInputProps('timer')}
      />
      <Center style={{marginTop: '1em'}}>
        <Button type='submit' color='teal'>
            {defaultParams ? 'Update' : 'Create'}
        </Button>
      </Center>
    </form>
  )
}

export default WeatherHoursForm;