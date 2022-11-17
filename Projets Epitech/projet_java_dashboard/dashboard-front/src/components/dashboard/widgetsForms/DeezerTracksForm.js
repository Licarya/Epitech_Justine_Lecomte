import { useForm } from '@mantine/form';

import { Button, Center, TextInput, NumberInput } from '@mantine/core';
import DeezerTracksWidget from '../widgets/DeezerTracksWidget';

const DeezerTracksForm = ({widgetType, defaultParams, onWidgetAdded, onWidgetUpdated}) => {
  const form = useForm({
    initialValues: {
      search: defaultParams ? defaultParams.search : '',
      timer: defaultParams ? defaultParams.timer : 60.0
    },
  
    validate: {
      search: value => (
        /\b([a-zA-ZÀ-ÿ][-,a-z. ']+[ ]*)+/
        .test(value) ? null : 'Invalid track name'
      ),
    }
  });

  const onFormSumbitValidated = (values) => {
    const timer = values.timer;
    delete values.timer;

    if (defaultParams)
      onWidgetUpdated(timer, values);
    else
      onWidgetAdded(widgetType, timer, <DeezerTracksWidget />, values);
  }

  return (
    <form onSubmit={form.onSubmit(values => onFormSumbitValidated(values))}>
      <TextInput
        withAsterisk
        required={true}
        label='Track name to search for'
        placeholder='Maloya Kabossé, Colors...'
        {...form.getInputProps('search')}
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

export default DeezerTracksForm;