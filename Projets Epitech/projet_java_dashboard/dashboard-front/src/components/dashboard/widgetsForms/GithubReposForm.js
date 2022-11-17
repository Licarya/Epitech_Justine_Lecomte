import { useForm } from '@mantine/form';

import { Button, Center, TextInput, NumberInput } from '@mantine/core';
import GithubReposWidget from '../widgets/GithubReposWidget';

const GithubReposForm = ({widgetType, defaultParams, onWidgetAdded, onWidgetUpdated}) => {
  const form = useForm({
    initialValues: {
      username: defaultParams ? defaultParams.username : '',
      timer: defaultParams ? defaultParams.timer : 60
    },
  
    validate: {
      username: value => (
        /^[a-zA-ZÀ-ÿ\d]{0,38}$/.test(value) ? null : 'Invalid Github username'
      ),
    }
  });

  const onFormSumbitValidated = (values) => {
    const timer = values.time;
    delete values.timer;

    if (defaultParams)
      onWidgetUpdated(timer, values);
    else
      onWidgetAdded(widgetType, timer, <GithubReposWidget />, values);
  }

  return (
    <form onSubmit={form.onSubmit(values => onFormSumbitValidated(values))}>
      <TextInput
        withAsterisk
        required={true}
        label='Github username'
        {...form.getInputProps('username')}
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

export default GithubReposForm;