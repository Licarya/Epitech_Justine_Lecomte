import { useForm } from '@mantine/form';

import { Button, Center, TextInput, NumberInput } from '@mantine/core';
import DeezerAlbumsWidget from '../widgets/DeezerAlbumsWidget';

const DeezerAlbumsForm = ({widgetType, defaultParams, onWidgetAdded, onWidgetUpdated}) => {
  const form = useForm({
    initialValues: {
      search: defaultParams ? defaultParams.search : '',
      timer: defaultParams ? defaultParams.timer: 60.0
    },
  
    validate: {
      search: value => (
        /\b([A-ZÀ-ÿ][-,a-z. ']+[ ]*)+/
        .test(value) ? null : 'Invalid album name'
      )
    }
  });

  const onFormSumbitValidated = (values) => {
    const timer = values.time;
    delete values.timer;

    if (defaultParams)
      onWidgetUpdated(timer, values);
    else
      onWidgetAdded(widgetType, timer, <DeezerAlbumsWidget />, values);
  }

  return (
    <form onSubmit={form.onSubmit(values => onFormSumbitValidated(values))}>
      <TextInput
        withAsterisk
        required={true}
        label='Album name to search for'
        placeholder='Black pumas, Feu...'
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

export default DeezerAlbumsForm;